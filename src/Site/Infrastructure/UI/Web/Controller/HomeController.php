<?php

declare(strict_types=1);

namespace App\Site\Infrastructure\UI\Web\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name:'app_site_home')]
class HomeController extends AbstractController
{
    public function __invoke(Request $request): Response
    {
        return $this->render('site/index.html.twig', [
            'title' => 'Strona główna'
        ]);
    }
}