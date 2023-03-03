<?php

namespace App\Controllers;



use App\Repository\UsersRepository;
use Twig\Environment;

class UserController
{

    private Environment $twig;



    public function __construct(Environment $twig)
    {
        $this->twig = $twig;

    }

    public function login(): void

    {
        echo $this->twig->render('login.html.twig');
    }


}
