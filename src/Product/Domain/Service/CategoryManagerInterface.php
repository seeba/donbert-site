<?php

declare(strict_types=1);

namespace App\Product\Domain\Service;

interface CategoryManagerInterface 
{
    public function getParentCategoryChoices();
}