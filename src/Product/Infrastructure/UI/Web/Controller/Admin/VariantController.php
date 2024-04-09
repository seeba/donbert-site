<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\UI\Web\Controller\Admin;

use App\Product\Application\Command\Sync\CreateProductCommand;
use App\Product\Application\DTO\ProductDTO;
use App\Product\Application\Query\GetVariantsQueryInterface;
use App\Product\Infrastructure\UI\Web\Form\ProductType;
use App\Shared\Application\Service\IdGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

final class VariantController extends AbstractController
{
    #[Route('admin/products/{productId}/variants', name:'admin-product-variant-index', methods:['GET', 'POST'])]
    public function index($productId, GetVariantsQueryInterface $getVariantsQuery) 
    {
        $variants = $getVariantsQuery->execute($productId);
        
        return $this->render('product/variant/index.html.twig',[
            'variants' => $variants,
            'productId' => $productId
        ]);
    }
      
    #[Route('admin/products/{productId}/variants/new', name:'admin-product-variant-add', methods:['GET', 'POST'])]
    public function create(
        $productId,
        Request $request, 
        MessageBusInterface $messageBus, 
        IdGeneratorInterface $idGenerator,
        ): Response
    {
        $productDTO = new ProductDTO();
        $form = $this->createForm(ProductType::class, $productDTO);
        $form->handleRequest($request);
//dd($productDTO);
        if ($form->isSubmitted() && $form->isValid()) {
            $command = new CreateProductCommand(
                    $idGenerator->generate()->toString(), 
                    $productDTO->name, 
                    $productDTO->categoriesIds
                );
            
                $messageBus->dispatch($command);

            return $this->redirectToRoute('app_site_home');
        }

        return $this->render('product/product/create.html.twig', [
            'form' => $form->createView()
        ]);
    }   
}

