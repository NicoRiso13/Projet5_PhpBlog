<?php

namespace App\Controllers;

use Twig\Environment;

class RegisterControllers
{

    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }
    public function registerPage(): void
    {
        echo $this->twig->render('register.html.twig');
    }

}
