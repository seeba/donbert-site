<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Controller;

use App\Product\Application\Command\Sync\CreateCategoryCommand;
use App\Product\Application\DTO\CategoryDTO;
use App\Product\Application\Form\CategoryType;
use App\Product\Domain\Service\CategoryManagerInterface;
use App\Shared\Application\Service\IdGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

final class CategoryController extends AbstractController
{
    #[Route('admin/category/new', name:'admin-category-add', methods:['GET'])]
    public function create(
        Request $request, 
        MessageBusInterface $messageBus, 
        CategoryManagerInterface $categoryManager,
        IdGeneratorInterface $idGenerator,
        ): Response
    {
        $categoryDTO = new CategoryDTO();
        $form = $this->createForm(CategoryType::class, $categoryDTO);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $command = new CreateCategoryCommand($idGenerator->generate()->toString(), $categoryDTO->name, $categoryDTO->parentId);
            $messageBus->dispatch($command);

            return $this->redirectToRoute('');
        }

        return $this->render('category/create.html.twig', [
            'form' => $form->createView()
        ]);
    }   
}
