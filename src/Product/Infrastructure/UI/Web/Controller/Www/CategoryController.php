<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\UI\Web\Controller\Www;

use App\Product\Domain\Service\CategoryManagerInterface;
use App\Shared\Application\Service\IdGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

final class CategoryController extends AbstractController
{
    #[Route('category/new', name:'category-add', methods:['GET', 'POST'])]
    public function create(
        Request $request, 
        MessageBusInterface $messageBus, 
        CategoryManagerInterface $categoryManager,
        IdGeneratorInterface $idGenerator,
        ): Response
    {
        

        return $this->render('site/index.html.twig', [
            'title' => "tutu"
        ]);
    }   
}

