<?php

namespace App\Service\CatalogItem;

use App\Configuration\CatalogItemConfiguration;
use App\Contract\DataStorage\XmlDataStorageInterface;
use App\Contract\DataValidator\XmlDataValidatorInterface;
use App\Entity\CatalogItem;
use App\Exception\NoDataSavedException;
use App\Exception\ReqFieldMissingException;
use App\Service\EntityManager\EntityManagerService;
use App\Utils\DataFormatUtils;
use Doctrine\ORM\EntityRepository;
use Exception;
use Psr\Log\LoggerInterface;
use SimpleXMLElement;

readonly class XmlDataStorage implements XmlDataStorageInterface
{
    private EntityRepository $catalogItemRepository;

    public function __construct(
        private XmlDataValidatorInterface $xmlDataValidator,
        private EntityManagerService $entityManagerService,
        private LoggerInterface        $logger
    ) {
        $this->catalogItemRepository = $this->entityManagerService
            ->getEntityManager()
            ->getRepository(CatalogItem::class);
    }


    /**
     * Processes and stores a collection of XML elements in the database in batches.
     *
     * @param SimpleXMLElement $elements The collection of XML elements to be processed and stored.
     * @return int The number of elements successfully processed and stored.
     * @throws NoDataSavedException If no elements were successfully saved.
     */
    public function store(SimpleXMLElement $elements): int
    {
        $batchSize = 100;
        $processedCount = 0;
        foreach ($elements as $element) {
            if ($this->processElement($element)) {
                $processedCount++;
            }

            // Flush and clear in batches to optimize performance
            if ($processedCount % $batchSize === 0) {
                $this->entityManagerService->flushAndClear();
            }
        }

        // This avoids an unnecessary flush if the last operation completed a batch.
        if ($processedCount % $batchSize !== 0) {
            $this->entityManagerService->flushAndClear();
        }

        if ($processedCount === 0) {
            throw new NoDataSavedException('No data is saved.');
        }

        return $processedCount;
    }

    private function processElement(SimpleXMLElement $element): bool
    {
        if (!$this->validateElement($element)) {
            return false;
        }

        try {
            $catalogItem = $this->catalogItemRepository->findOneBy(['entity_id' => $element->entity_id]) ?:
                new CatalogItem();
            $catalogItemEntity = $this->assignCatalogItem($catalogItem, $element);
            $this->entityManagerService->getEntityManager()->persist($catalogItemEntity);
            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function validateElement($element): bool
    {
        try {
            $this->xmlDataValidator->validateRequiredFields($element, CatalogItemConfiguration::$requiredFields);
            return true;
        } catch (ReqFieldMissingException $e) {
            $this->logger->error(sprintf('Entity ID %d: %s.', intval($element->entity_id), $e->getMessage()));
            return false;
        }
    }

    private function assignCatalogItem(CatalogItem $catalogItem, SimpleXMLElement $element): CatalogItem
    {
        foreach (CatalogItemConfiguration::$xmlDataPropertyMap as $xmlField => $info) {
            if (isset($element->$xmlField)) {
                $catalogItem->{$info['setter']}(DataFormatUtils::formatValue($element->$xmlField, $info['type']));
            }
        }

        return $catalogItem;
    }
}