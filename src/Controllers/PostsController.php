<?php

namespace App\Controllers;

use App\Models\PostsModel;
use Twig\Environment;



class PostsController
{


    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }


    public function PostsView()
    {

        $posts = new PostsModel();
        $posts->getPosts();

        echo $this->twig->render('posts.html.twig');

    }




}