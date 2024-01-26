<?php

declare(strict_types=1);

namespace App\Product\Domain\Service;

use App\Product\Domain\Repository\CategoryRepositoryInterface;

class CategoryManager implements CategoryManagerInterface
{
   public function __construct(
        private CategoryRepositoryInterface $repository
    )
   {
   }
   
   public function getParentCategoryChoices()
   {
    $categories = $this->repository->findAll();
    $choices = [];

    foreach ($categories as $category) {
        $choices[$category->getName()] = $category->getId();
    }

    return $choices;
   }
}
