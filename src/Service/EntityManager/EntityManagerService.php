<?php

namespace App\Service\EntityManager;

use Doctrine\ORM\EntityManagerInterface;

readonly class EntityManagerService
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function getEntityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }

    public function flushAndClear(): void
    {
        $this->getEntityManager()->flush();
        $this->getEntityManager()->clear();
    }
}
