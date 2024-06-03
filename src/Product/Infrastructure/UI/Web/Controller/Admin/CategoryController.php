<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\UI\Web\Controller\Admin;

use App\Product\Application\Command\Sync\CreateCategory\CreateCategoryCommand;
use App\Product\Application\DTO\CategoryDTO;
use App\Product\Application\Query\GetCategoriesQueryInterface;
use App\Product\Infrastructure\UI\Web\Form\CategoryType;
use App\Product\Domain\Service\CategoryManagerInterface;
use App\Shared\Application\Service\IdGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;
#[Route('admin/categories')]
class CategoryController extends AbstractController
{
    #[Route('/', name:'admin-categories-index', methods:['GET', 'POST'])]
    public function index(GetCategoriesQueryInterface $getCategoriesQuery)
    {
        $categories= $getCategoriesQuery->execute();

        return $this->render('product/category/index.html.twig',[
            'categories' => $categories
        ]);
    }
    
    #[Route('/new', name:'admin-categories-add', methods:['GET', 'POST'])]
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
            
            $command = new CreateCategoryCommand(
                $idGenerator->generate()->toString(), 
                $categoryDTO->name, 
                $categoryDTO->parentId);
            
                $messageBus->dispatch($command);

            return $this->redirectToRoute('admin-categories-index');
        }

        return $this->render('product/category/create.html.twig', [
            'form' => $form->createView()
        ]);
    }   
}

