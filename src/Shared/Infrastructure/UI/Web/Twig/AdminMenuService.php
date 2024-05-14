<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\UI\Web\Twig;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class AdminMenuService
{
    private $twig;
    private $urlGenerator;
    private $formFactory;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function getMenuContent(): string
    {
    
        return $this->twig->render('admin_menu.html.twig');
    }
}