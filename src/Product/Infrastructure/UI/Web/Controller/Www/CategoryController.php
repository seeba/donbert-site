<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\UI\Web\Controller\Www;

use App\Product\Application\Query\GetCategories\GetCategoriesForMenuQueryInterface;
use App\Product\Application\Query\GetProducts\GetProductsForCategoryQueryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CategoryController extends AbstractController
{
    #[Route('/category/{slug}', name:'www-category', methods:['GET'])]
    public function create(
        $slug,
        GetProductsForCategoryQueryInterface $getProductsForCategoryQuery,
        GetCategoriesForMenuQueryInterface $query
        ): Response
    {
        $category = $getProductsForCategoryQuery->execute($slug);
        dd($query->execute());
        

        return $this->render('product/category/www/show.html.twig', [
            'title' => "tutu",
            'category' => $category
        ]);
    }   
}

