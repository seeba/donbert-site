<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Query;

use App\Product\Application\Query\GetSizeAttributesQueryInterface;
use App\Product\Application\Query\GetVariantsQueryInterface;
use App\Product\Infrastructure\Entity\Attribute\Attribute;
use App\Product\Infrastructure\Entity\Attribute\SizeAttribute;
use App\Product\Infrastructure\Entity\Variant;
use Doctrine\ORM\EntityManagerInterface;

final class GetSizeAttributesQuery implements GetSizeAttributesQueryInterface

{
    public function __construct(
        private EntityManagerInterface $entityManager
    )
    {
    }

    public function execute() :array
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();

        $queryBuilder
            ->select(
                'a.id',
                'a.name',
                )
            ->from(SizeAttribute::class, 'a')
            
            ;

        $results = $queryBuilder->getQuery()->getArrayResult();

        return $results;
        
    }
}