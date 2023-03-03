<?php

namespace App\Controllers;

use App\Repository\CommentarysRepository;
use App\Repository\PostsRepository;
use App\Repository\UsersRepository;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;


class PostController
{
    private Environment $twig;
    private PostsRepository $repository;
    private CommentarysRepository $commentarysRepository;
    private UsersRepository $usersRepository;


    public function __construct(Environment $twig, PostsRepository $repository, CommentarysRepository $commentarysRepository, UsersRepository $usersRepository)
    {
        $this->twig = $twig;
        $this->repository = $repository;
        $this->commentarysRepository = $commentarysRepository;
        $this->usersRepository = $usersRepository;
    }

    public function postsView(): void
    {
        $posts = $this->repository->findAll();
        echo $this->twig->render('posts.html.twig', ["posts" => $posts]);
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     * @throws Exception
     */
    public function postDetails(string $id): void
    {
        $users = $this->usersRepository->findByCommentary($id);
        $post = $this->repository->findOneById($id);
        $commentarys = $this->commentarysRepository->findByPost($id);
        echo $this->twig->render('detailsPosts.html.twig', ["post" => $post, "commentarys" => $commentarys, "users" => $users]);

    }

}
