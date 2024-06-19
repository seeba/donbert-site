<?php

declare(strict_types=1);

namespace App\Site\Infrastructure\UI\Web\Twig;

use App\Product\Application\Query\GetCategories\GetCategoriesForMenuQueryInterface;
use Twig\Environment;

class MenuService
{
    public function __construct(
        private Environment $twig,
        private GetCategoriesForMenuQueryInterface $query     
    ) {
    }

    public function getMenuContent(): string
    {
        $categories = $this->query->execute();

       return '';
    }
    
}