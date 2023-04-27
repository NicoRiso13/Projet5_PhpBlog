<?php

namespace App\Controllers;

use App\Repository\PostsRepository;
use App\Router\Request;
use App\Validation\FormContactValidator;
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

        $formValues = $this->request->getPosts();
        $validator = new FormContactValidator();
        $violations = $validator->contactValidator($formValues);

        if (count($violations) === 0) {

            $surname = $formValues['surname'];
            $name = $formValues['name'];
            $email = $formValues['email'];

            $to = "nicolas.riso13@gmail.com";
            $subject = "Message utilisateur Blog PHP";
            $message = $formValues['message'];
            $headers[] = 'MIME-Version: 1.0';
            $headers[] = 'Content-type: text/html; charset=iso-8859-1';
            // En-têtes additionnels
            $headers[] = 'To: Admin <MonblogPhp@gmail.com>';
            $headers[] = "From: ".$surname." ".$name." <".$email."> " ;

            mail($to, $subject, $message, implode("\r\n", $headers));

            $this->request->getSession()->addMessage('Message envoyé avec succés !');
            header('location: /contact');
            return;
        }
        echo $this->twig->render('/contact.html.twig', ["formValues" => $formValues, "formContactValidations" => $violations]);
    }
}
