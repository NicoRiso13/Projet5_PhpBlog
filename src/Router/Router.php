<?php

namespace App\Router;

use AltoRouter;
use App\Repository\CommentarysRepository;
use App\Repository\PostsRepository;
use App\Repository\UsersRepository;
use Twig\Environment;

class Router
{

    public function routes(Environment $twig, \PDO $database): void
    {

        $router = new AltoRouter();

        $router->map('GET', '/', [new \App\Controllers\HomePageController($twig), 'homePage']);
        $router->map('GET', '/login', [new \App\Controllers\UserController($twig, new UsersRepository($database) ), 'login']);
        $router->map('GET', '/register', [new \App\Controllers\RegisterControllers($twig), 'registerPage']);
        $router->map('GET', '/posts', [new \App\Controllers\PostController($twig, new PostsRepository($database), new CommentarysRepository($database), new UsersRepository($database)), 'postsView']);
        $router->map('GET', '/posts/[i:id]', [new \App\Controllers\PostController($twig, new PostsRepository($database), new CommentarysRepository($database), new UsersRepository($database)), 'postDetails']);

        $match = $router->match();

        if( is_array($match) && is_callable( $match['target'] ) ) {
            call_user_func_array( $match['target'], $match['params'] );
        } else {
            // no route was matched
            header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
        }


    }
}
