<?php

namespace App\Controllers;

use App\Repository\PostsRepository;
use Twig\Environment;


class PostsController
{
    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function postsView()
    {

        $postsRepository = new PostsRepository();
        $posts = $postsRepository->indexPosts();


        echo $this->twig->render('posts.html.twig');

    }


}