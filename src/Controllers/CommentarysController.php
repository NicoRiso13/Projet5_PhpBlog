<?php

namespace App\Controllers;

use App\Entity\CommentaryEntity;
use App\Exceptions\EntityNotFoundException;
use App\Repository\CommentarysRepository;
use App\Repository\PostsRepository;
use App\Repository\UsersRepository;
use App\Router\Request;
use App\Validation\CommentaryValidator;
use Twig\Environment;


class CommentarysController
{

    private CommentarysRepository $commentarysRepository;


    private Request $request;


    public function __construct( CommentarysRepository $commentarysRepository, Request $request)
    {

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
}
