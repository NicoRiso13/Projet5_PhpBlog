<?php

namespace App\Controllers;

use App\Entity\CommentaryEntity;
use App\Entity\UsersEntity;
use App\Exceptions\EntityNotFoundException;
use App\Repository\CommentarysRepository;
use App\Repository\PostsRepository;
use App\Repository\UsersRepository;
use App\Router\Request;
use App\Validation\CommentaryValidator;
use App\Validation\RegisterValidator;
use Exception;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;


class PostController
{
    private Environment $twig;
    private PostsRepository $postsRepository;
    private CommentarysRepository $commentarysRepository;
    private UsersRepository $usersRepository;



    public function __construct(Environment $twig, PostsRepository $postsRepository, CommentarysRepository $commentarysRepository, UsersRepository $usersRepository)
    {
        $this->twig = $twig;
        $this->postsRepository = $postsRepository;
        $this->commentarysRepository = $commentarysRepository;
        $this->usersRepository = $usersRepository;

    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     * @throws Exception
     */
    public function postsView(): void
    {
        $posts = $this->postsRepository->findAll();
        foreach ($posts as $post){
            $user = $this->usersRepository->findOneById($post->getUserId());
            $post->setUsersEntity($user);
        }
        echo $this->twig->render('posts.html.twig', ["posts" => $posts]);
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     * @throws Exception
     */
    public function postDetails(int $id): void
    {
        $post = $this->postsRepository->findOneById($id);
        $commentarys = $this->commentarysRepository->findByPost($id);
        foreach ($commentarys as $commentary){
            $user = $this->usersRepository->findOneById($commentary->getUserId());
            $commentary->setUsersEntity($user);
        }

        echo $this->twig->render('detailsPosts.html.twig', ["post" => $post, "commentarys" => $commentarys]);
    }

}
