<?php

namespace App\Controllers;

use Twig\Environment;
class LoginController
{

    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }
    public function loginPage(): void
    {
        echo $this->twig->render('login.html.twig');
    }
}
