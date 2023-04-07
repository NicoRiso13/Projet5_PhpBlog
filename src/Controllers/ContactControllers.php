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
        $to = "nicolas.riso13@gmail.com";
        $subject = "Test utilisation du mail";
        $message = "Salut, ceci est un mail de test";
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';
        // En-têtes additionnels
        $headers[] = 'To: Mary <mary@example.com>, Kelly <kelly@example.com>';
        $headers[] = 'From: Anniversaire <anniversaire@example.com>';
        $headers[] = 'Cc: anniversaire_archive@example.com';
        $headers[] = 'Bcc: anniversaire_verif@example.com';
        // Envoi


        if(mail($to, $subject, $message, implode("\r\n", $headers)))
            echo 'Envoyé !';
        else
            echo 'Erreur envoi';

        echo $this->twig->render('/contact.html.twig');
    }


}
