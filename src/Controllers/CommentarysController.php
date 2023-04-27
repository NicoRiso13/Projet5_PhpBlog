<?php

namespace App\Controllers;

use App\Entity\CommentaryEntity;
use App\Exceptions\AccessDeniedException;
use App\Exceptions\EntityNotFoundException;
use App\Repository\CommentarysRepository;
use App\Repository\PostsRepository;
use App\Repository\UsersRepository;
use App\Router\Request;
use App\Validation\CommentaryValidator;
use Exception;
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
    private PostsRepository $postsRepository;


    public function __construct(Environment $twig, UsersRepository $usersRepository, CommentarysRepository $commentarysRepository, PostsRepository $postsRepository, Request $request)
    {
        $this->twig = $twig;
        $this->usersRepository = $usersRepository;
        $this->commentarysRepository = $commentarysRepository;
        $this->postsRepository = $postsRepository;
        $this->request = $request;

    }


    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     * @throws Exception
     */
    public function addCommentary(int $id): void
    {
        $commentValues = $this->request->getPosts();
        $validator = new CommentaryValidator();
        $violations = $validator->commentValidator($commentValues);
        if (count($violations) === 0) {
            $userId = $this->request->getSession()->getUser()->getId();
            $commentaryEntity = new CommentaryEntity(null, $commentValues['comment'], null, new \DateTimeImmutable(),'submission', $userId , $id);
            $this->commentarysRepository->add($commentaryEntity);
            $this->request->getSession()->addMessage('Message en attente de validation !');
            header('location: /posts/'.$id);

            return;
        }
        echo $this->twig->render('detailsPosts.html.twig', ["post" => $this->postsRepository->findOneById($id), "commentary" => $commentValues, "commentaryViolations" => $violations]);
    }


    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     * @throws Exception
     */
    public function viewAllCommentarys(): void
    {
        $user = $this->request->getSession()->getUser();
        if ($user === null || !$user->isAdmin()) {
            throw new AccessDeniedException();
        }
        $commentarys = $this->commentarysRepository->findAll();
        foreach ($commentarys as $commentary) {
            $user = $this->usersRepository->findOneByid($commentary->getUserId());
            $commentary->setUsersEntity($user);
        }
        echo $this->twig->render('/Admin/commentarys.html.twig', ["commentarys" => $commentarys, "user" => $user]);
    }

///    VALIDATION D'UN COMMENTAIRE
    public function detailsCommentary(int $id): void
    {
        $commentarys = $this->commentarysRepository->findOneById($id);
        foreach ($commentarys as $commentary) {
            $user = $this->usersRepository->findOneById($commentary->getUserId());
            $commentarys->setUsersEntity($user);
        }
        echo $this->twig->render('/Admin/detailsCommentary.html.twig', ["commentary" => $commentarys]);
    }

///    VALIDATION D'UN COMMENTAIRE
    public function commentaryIsValidate(int $id): void
    {
        $user = $this->request->getSession()->getUser();
        if ($user === null || !$user->isAdmin()) {
            throw new AccessDeniedException();
        }
        try {
            $commentaryEntity = $this->commentarysRepository->findOneById($id);
        } catch (EntityNotFoundException $e) {
            http_response_code(404);
            return;
        }

        $commentaryEntity->setStatus('validate');
        $this->commentarysRepository->updateStatusCommentary($commentaryEntity);
        $this->request->getSession()->addMessage('Commentaire validé avec succés !');
        header('location: /commentarys');

    }
///    REFUS D'UN COMMENTAIRE
    public function commentaryIsRefused(int $id): void
    {
        $user = $this->request->getSession()->getUser();
        if ($user === null || !$user->isAdmin()) {
            throw new AccessDeniedException();
        }
        try {
            $commentaryEntity = $this->commentarysRepository->findOneById($id);
        } catch (EntityNotFoundException $e) {
            http_response_code(404);
            return;
        }

        $commentaryEntity->setStatus('refused');
        $commentaryEntity->setRefusedAt(new \DateTime('now'));
        $this->commentarysRepository->updateStatusCommentary($commentaryEntity);
        $this->request->getSession()->addMessage('Commentaire refusé avec succés !');
        header('location: /commentarys');

    }


}


