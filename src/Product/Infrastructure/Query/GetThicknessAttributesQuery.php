<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Query;

use App\Product\Application\Query\GetThicknessAttributesQueryInterface;
use App\Product\Infrastructure\Entity\Attribute\ThicknessAttribute;
use Doctrine\ORM\EntityManagerInterface;

class GetThicknessAttributesQuery implements GetThicknessAttributesQueryInterface

{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
    }

    public function execute() :array
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();

        $queryBuilder
            ->select(
                'a.id',
                'a.name'
                )
            ->from(ThicknessAttribute::class, 'a')
            ;

        $results = $queryBuilder->getQuery()->getArrayResult();

        return $results;       
    }
}