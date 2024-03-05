<?php

declare(strict_types=1);

namespace App\Site\Infrastructure\UI\Web\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/contact', name:'app_site_contact')]
class ContactController extends AbstractController
{
    public function __invoke(Request $request): Response
    {
        return $this->render('site/contact.html.twig', [
            'title' => 'Kontakt'
        ]);
    }
}