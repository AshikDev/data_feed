<?php

namespace App\Repository;

use App\Entity\CatalogItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CatalogItem>
 *
 * @method CatalogItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method CatalogItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method CatalogItem[]    findAll()
 * @method CatalogItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CatalogItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CatalogItem::class);
    }
}
