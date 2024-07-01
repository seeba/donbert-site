<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\UI\Web\Controller\Admin;

use App\Product\Application\Command\Sync\CreateAttribute\CreateAttributeCommand;
use App\Product\Application\Command\Sync\CreateAttribute\DTO\CreateAttributeDTO;
use App\Product\Domain\ValueObject\AttributeType;
use App\Product\Infrastructure\Query\GetAttributesQuery;
use App\Product\Infrastructure\UI\Web\Form\AttributeType as FormAttributeType;
use App\Shared\Application\Service\IdGeneratorInterface;
use App\Shared\Domain\ValueObject\Color;
use App\Shared\Domain\ValueObject\Quantity;
use App\Shared\Domain\ValueObject\Size;
use App\Shared\Domain\ValueObject\Thickness;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

class AttributeController extends AbstractController
{
    #[Route('admin/products/attributes', name:'admin-products-attributes-index', methods:['GET', 'POST'])]
    public function index(GetAttributesQuery $query)
    {
        $attributes = $query->execute();
        return $this->render('admin/product/attribute/index.html.twig', [
            'attributes' => $attributes
        ]); 
    }
    
    #[Route('admin/products/attributes/new', name:'admin-products-attributes-add', methods:['GET', 'POST'])]
    public function create(
        Request $request, 
        MessageBusInterface $messageBus, 
        IdGeneratorInterface $idGenerator
        ): Response
    {
        $form = $this->createForm(FormAttributeType::class);
        $form->handleRequest($request);
       
        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();
        
            $attributeId = $idGenerator->generate()->toString();
            $createAttributeDTO = new CreateAttributeDTO(
                $data['name'],
                AttributeType::from($data['type']),
                !isset($data['color']) 
                    ? null 
                    : new Color($data['color']),
                !isset($data['width']) 
                    ? null 
                    : new Size((int)$data['width'], (int)$data['height'], (int)$data['liter_capacity']),
                !isset($data['thickness']) 
                    ? null 
                    : new Thickness((float)$data['thickness']),
                !isset($data['quantity_per_roll']) 
                    ? null 
                    : new Quantity((int)$data['quantity_per_roll']),
            );
            $createAttributeCommand = new CreateAttributeCommand(
                $attributeId,
                $createAttributeDTO                
            );
            
            $messageBus->dispatch($createAttributeCommand);

            return $this->redirectToRoute('admin-products-attributes-index');  
        }

        return $this->render('admin/product/attribute/create.html.twig', [
            'form' => $form->createView()
        ]); 
    }
}