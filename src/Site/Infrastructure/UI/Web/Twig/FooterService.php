<?php

declare(strict_types=1);

namespace App\Site\Infrastructure\UI\Web\Twig;

use Twig\Environment;

class FooterService
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function getFooterContent(): string
    {
        return $this->twig->render('site/footer.html.twig');
    }
}