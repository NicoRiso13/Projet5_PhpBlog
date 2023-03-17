<?php

namespace App\Controllers;

use App\Entity\CommentaryEntity;
use App\Exceptions\EntityNotFoundException;
use App\Repository\CommentarysRepository;
use App\Repository\UsersRepository;
use App\Router\Request;
use App\Validation\CommentaryValidator;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;


class CommentarysController
{

    private CommentarysRepository $commentarysRepository;
    private Environment $twig;

    private Request $request;
    private UsersRepository $usersRepository;


    public function __construct(Environment $twig, UsersRepository $usersRepository,CommentarysRepository $commentarysRepository, Request $request)
    {
        $this->twig = $twig;
        $this->usersRepository = $usersRepository;
        $this->commentarysRepository = $commentarysRepository;
        $this->request = $request;

    }



    public function addCommentary(): void
    {
        $commentValues = $this->request->getPosts();
        $validator = new CommentaryValidator();
        $violations = $validator->commentValidator($commentValues);

        if (count($violations) === 0) {
            try {
                $commentaryEntity = new CommentaryEntity(null, $commentValues['comment'], null, $commentValues['status'], $commentValues['reason'], $commentValues['userId'], $commentValues['postId']);
                $this->commentarysRepository->add($commentaryEntity);
                header('location: /posts/[i:id]');
                return;
            } catch (EntityNotFoundException $e) {
                $violations ['errors'] [] = "Données de formulaire incorrecte";
            }
        }
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function viewAllCommentarys(): void
    {

        $commentarys = $this->commentarysRepository->findAll();
        foreach ($commentarys as $commentary){
            $user = $this->usersRepository->findOneById($commentary->getUserId());
            $commentary->setUsersEntity($user);
        }
        echo $this->twig->render('commentarys.html.twig', ["commentarys" => $commentarys, "user" => $user]);
    }



    public function detailsCommentary(int $id): void
    {

        $commentarys = $this->commentarysRepository->findOneById($id);
        foreach ($commentarys as $commentary){
            $user = $this->usersRepository->findOneById($commentary->getUserId());
            $commentarys->setUsersEntity($user);
        }
        echo $this->twig->render('detailsCommentary.html.twig', ["commentary" => $commentarys]);
    }

}
