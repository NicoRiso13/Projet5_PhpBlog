<?php

namespace App\Controllers;

use App\Repository\PostsRepository;
use App\Router\Request;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ContactControllers
{

    private Environment $twig;

    private Request $request;



    public function __construct(Environment $twig, Request $request)
    {
        $this->twig = $twig;
        $this->request = $request;
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function contact(): void
    {
        echo $this->twig->render('/contact.html.twig');
    }


}
