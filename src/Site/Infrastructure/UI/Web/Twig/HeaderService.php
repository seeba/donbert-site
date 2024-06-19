<?php

declare(strict_types=1);

namespace App\Site\Infrastructure\UI\Web\Twig;

use App\Newsletter\Infrastructure\UI\Web\Form\NewsletterType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class HeaderService
{
    private $twig;
    private $urlGenerator;
    private $formFactory;

    public function __construct(Environment $twig, FormFactoryInterface $formFactory, UrlGeneratorInterface $urlGenerator)
    {
        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->urlGenerator = $urlGenerator;
    }

    public function getHeaderContent(): string
    {

        return $this->twig->render('site/header.html.twig', [
            
        ]);
    }
}