<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\UI\Web\Controller;

use App\Product\Application\Command\Sync\CreateProductCommand;
use App\Product\Application\DTO\ProductDTO;
use App\Product\Infrastructure\UI\Web\Form\ProductType;
use App\Shared\Application\Service\IdGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

final class ProductController extends AbstractController
{
    #[Route('admin/product/new', name:'admin-product-add', methods:['GET', 'POST'])]
    public function create(
        Request $request, 
        MessageBusInterface $messageBus, 
        IdGeneratorInterface $idGenerator,
        ): Response
    {
        $productDTO = new ProductDTO();
        $form = $this->createForm(ProductType::class, $productDTO);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $command = new CreateProductCommand(
                $idGenerator->generate()->toString(), 
                $productDTO->name, 
                );
            
                $messageBus->dispatch($command);

            return $this->redirectToRoute('');
        }

        return $this->render('product/product/create.html.twig', [
            'form' => $form->createView()
        ]);
    }   
}

