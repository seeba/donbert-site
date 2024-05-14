<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\UI\Web\Controller\Admin;

use App\Product\Application\Command\Sync\AddAttributesToVariant\AddAttributesToVariantCommand;
use App\Product\Application\Command\Sync\AddImagesToVariantCommand;
use App\Product\Application\Command\Sync\CreateVariantCommand;
use App\Product\Application\DTO\VariantDTO;
use App\Product\Application\Query\GetVariantsQueryInterface;
use App\Product\Infrastructure\UI\Web\Form\VariantType;
use App\Shared\Application\Service\IdGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

final class VariantController extends AbstractController
{
    #[Route('admin/products/{productId}/variants', name:'admin-products-variants-index', methods:['GET', 'POST'])]
    public function index($productId, GetVariantsQueryInterface $getVariantsQuery) 
    {
        $variants = $getVariantsQuery->execute($productId);
        $filesystem = new Filesystem();
        $filesystem->mkdir('/tmp/photos', 0700);

        return $this->render('product/variant/index.html.twig',[
            'variants' => $variants,
            'productId' => $productId
        ]);
    }
      
    #[Route('admin/products/{productId}/variants/new', name:'admin-products-variants-add', methods:['GET', 'POST'])]
    public function create(
        $productId,
        Request $request, 
        MessageBusInterface $messageBus, 
        IdGeneratorInterface $idGenerator,
        ): Response
    {
     
        $variantDTO = new VariantDTO($productId);
        $form = $this->createForm(VariantType::class, $variantDTO);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $variantId = $idGenerator->generate()->toString();
            $createVariantCommand = new CreateVariantCommand(
                    $variantId, 
                    $variantDTO->name, 
                    $variantDTO->productId);   
            $messageBus->dispatch($createVariantCommand);
          
            $addImagesToVariantCommand = new AddImagesToVariantCommand(
                $variantId,
                $variantDTO->images
            );
            $messageBus->dispatch($addImagesToVariantCommand);
            $attributes = [
                $variantDTO->attributes->size,
                $variantDTO->attributes->color,
                $variantDTO->attributes->thickness,
                $variantDTO->attributes->quantityPerRoll
            ];

            $addAttributesToVariantCommand = new AddAttributesToVariantCommand($variantId, $attributes);

            $messageBus->dispatch($addAttributesToVariantCommand);

            return $this->redirectToRoute('admin-products-variants-index',['productId' => $productId]);
        }

        return $this->render('product/variant/create.html.twig', [
            'form' => $form->createView()
        ]);
    }   
}

