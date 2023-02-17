<?php

namespace App\Controllers;

use Twig\Environment;

class LoginSubscribe
{

    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function Login()
    {
        echo $this->twig->render('login.html.twig');
    }
}