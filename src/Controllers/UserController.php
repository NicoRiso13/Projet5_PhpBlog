<?php

namespace App\Controllers;



use App\Exceptions\EntityNotFoundException;
use App\Repository\UsersRepository;
use App\Router\Request;
use App\Validation\UserLoginValidator;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class UserController
{

    private Environment $twig;
    private Request $request;
    private UsersRepository $usersRepository;


    public function __construct(Environment $twig, Request $request, UsersRepository $usersRepository)
    {
        $this->twig = $twig;
        $this->request = $request;
        $this->usersRepository = $usersRepository;
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function login(): void
    {
        $values = $this->request->getPosts();
        $validator = new UserLoginValidator();
        $violations = $validator->validate($values);
        if(count($violations) === 0){
            try {
                $user = $this->usersRepository->findByEmailAndPassword($values['loginEmail'], $values['loginPassword']);
                $this->request->getSession()->setUser($user);
                header("Location: /");
                return ;
            } catch (EntityNotFoundException $e) {
                $violations ['errors'] [] = "Email ou Password invalide";
            }
        }
        echo $this->twig->render('login.html.twig', ["violations" => $violations, "values" => $values]);
    }

}
