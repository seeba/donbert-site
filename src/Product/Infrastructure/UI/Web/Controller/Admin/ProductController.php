<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\UI\Web\Controller\Admin;

use App\Product\Application\Command\Sync\AddImagesToProduct\AddImagesToProductCommand;
use App\Product\Application\Command\Sync\CreateProduct\CreateProductCommand;
use App\Product\Application\DTO\ProductDTO;
use App\Product\Application\Query\GetProductsQueryInterface;
use App\Product\Infrastructure\UI\Web\Form\ProductType;
use App\Shared\Application\Service\IdGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('admin/products')]
class ProductController extends AbstractController
{
    #[Route('/', name:'admin-products-index', methods:['GET', 'POST'])]
    public function index(GetProductsQueryInterface $getProductsQuery) 
    {
        $products = $getProductsQuery->execute();
        return $this->render('product/product/index.html.twig',[
            'products' => $products
        ]);
    }
      
    #[Route('/new', name:'admin-products-add', methods:['GET', 'POST'])]
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
            $productId = $idGenerator->generate()->toString();
            
            $messageBus->dispatch(new CreateProductCommand(
                $productId, 
                $productDTO->name, 
                $productDTO->categoriesIds,
                $productDTO->size
            ));

            $messageBus->dispatch(new AddImagesToProductCommand(
                $productId,
                $productDTO->images
            ));

            return $this->redirectToRoute('app_site_home');
        }

        return $this->render('product/product/create.html.twig', [
            'form' => $form->createView()
        ]);
    }   
}

