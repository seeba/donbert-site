<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\UI\Web\Controller\Www;

use App\Product\Application\Query\GetProducts\GetProductsForCategoryQueryInterface;
use App\Product\Domain\Service\CategoryManagerInterface;
use App\Shared\Application\Service\IdGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

final class CategoryController extends AbstractController
{
    #[Route('/category/{categoryId}', name:'www-category', methods:['GET', 'POST'])]
    public function create(
        $categoryId,
        Request $request, 
        IdGeneratorInterface $idGenerator,
        GetProductsForCategoryQueryInterface $getProductsForCategoryQuery
        ): Response
    {
        $category = $getProductsForCategoryQuery->execute('018fdeda-7582-7111-bdd4-7a83d5f31544');

        $category = $getProductsForCategoryQuery->execute($categoryId);
        dump($category);

        return $this->render('product/category/www/show.html.twig', [
            'title' => "tutu",
            'category' => $category
        ]);
    }   
}

