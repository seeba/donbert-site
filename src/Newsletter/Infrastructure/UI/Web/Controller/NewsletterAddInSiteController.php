<?php

declare(strict_types=1);

namespace App\Newsletter\Infrastructure\UI\Web\Controller;

use App\Newsletter\Infrastructure\UI\Web\Form\NewsletterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/newsletter/add', name:'app_newsletter_add_in_site', methods: ['POST', "GET"])]
class NewsletterAddInSiteController extends AbstractController
{
    public function __invoke(Request $request) : JsonResponse 
    {
        $form = $this->createForm(NewsletterType::class, null, [
            'action' => $this->generateUrl('app_newsletter_add_in_site')
        ]);
        $form->handleRequest($request);

        if ($form->isValid()) {
            return new JsonResponse([
                'msg' => 'Zostałeś zpaisany',
                'status' => 1
            ]);
        }
    }
}