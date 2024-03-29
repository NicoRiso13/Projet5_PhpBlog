<?php

namespace App\Controllers;

use Twig\Environment;


class HomePageController
{
    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }


    public function homePage(): void
    {
        echo $this->twig->render('homePage.html.twig');
    }

}
