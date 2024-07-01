<?php

declare(strict_types=1);

namespace App\User\Infrastructure\UI\Web\Controller\Admin;

use App\Shared\Application\Service\IdGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('admin/users')]
class UserController extends AbstractController
{
    #[Route('/', name:'admin-users-index', methods:['GET'])]
    public function index()
    {

    }
    #[Route('/new', name:'admin-users-add', methods:['GET', 'POST'])]
    public function create(
        Request $request, 
        MessageBusInterface $messageBus,
        IdGeneratorInterface $idGenerator
    ): Response
    {
        
    }
}