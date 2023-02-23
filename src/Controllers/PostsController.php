<?php

namespace App\Controllers;

use App\Repository\PostsRepository;
use Twig\Environment;


class PostsController
{
    private Environment $twig;
    private PostsRepository $repository;


    public function __construct(Environment $twig, PostsRepository $repository)
    {
        $this->twig = $twig;
        $this->repository = $repository;
    }

    public function postsView():void
    {

        $posts = $this->repository->indexPosts();

        echo $this->twig->render('posts.html.twig', ["posts" => $posts]);



    }


}