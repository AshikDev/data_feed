<?php

namespace App\Service\CatalogItem;

use App\Contract\DataStore\XmlDataHandlerInterface;
use App\Contract\DataStore\XmlDataStoreInterface;
use App\Contract\FileValidator\FileReadableCheckerInterface;
use App\Exception\FileNotReadableException;
use App\Exception\NoDataSavedException;
use DOMDocument;
use SimpleXMLElement;
use XMLReader;

readonly class XmlDataHandler implements XmlDataHandlerInterface
{
    private const BATCH_SIZE = 100;
    private const XML_PARENT_NODE = 'catalog';
    private const XML_CHILD_NODE = 'item';

    public function __construct(
        private FileReadableCheckerInterface $fileReadableChecker,
        private XmlDataStoreInterface $xmlDataStore
    ) { }

    /**
     * {@inheritDoc}
     */
    public function extractAndSave(string $filepath): int
    {
        // Validates if the file is readable
        $this->fileReadableChecker->validateFile($filepath);

        $reader = new XMLReader();
        if (!$reader->open($filepath)) {
            throw new FileNotReadableException("Failed to open XML file: $filepath");
        }

        $counter = 0;
        $savedRows = 0;
        $batch = new SimpleXMLElement('<' . self::XML_PARENT_NODE . 's/>');
        while ($reader->read()) {
            if ($reader->nodeType == XMLReader::ELEMENT && $reader->name == self::XML_CHILD_NODE) {
                $dom = new DOMDocument();
                $domNode = $reader->expand($dom);
                $simpleXmlNode = simplexml_import_dom($domNode);
                $this->appendSimpleXml($batch, $simpleXmlNode);
                $counter++;

                // Store and reset every 100 nodes
                if ($counter % self::BATCH_SIZE === 0) {
                    $savedRows += $this->xmlDataStore->store($batch);
                    // reset batch
                    $batch = new SimpleXMLElement('<' . self::XML_PARENT_NODE . 's/>');
                }
            }
        }

        $reader->close();

        if ($counter % self::BATCH_SIZE !== 0) {
            $savedRows += $this->xmlDataStore->store($batch);
        }

        if ($savedRows === 0) {
            throw new NoDataSavedException('No Data is Saved');
        }

        return $savedRows;
    }

    /**
     * Merges one SimpleXMLElement into another.
     *
     * @param SimpleXMLElement $to
     * @param SimpleXMLElement $from
     * @return void
     */
    private function appendSimpleXml(SimpleXMLElement $to, SimpleXMLElement $from): void
    {
        $toDom = dom_import_simplexml($to);
        $fromDom = dom_import_simplexml($from);
        $toDom->appendChild($toDom->ownerDocument->importNode($fromDom, true));
    }
}
