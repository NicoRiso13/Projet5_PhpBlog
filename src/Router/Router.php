<?php

namespace App\Router;

use AltoRouter;
use Twig\Environment;

class Router
{

    public function routes(Environment $twig )
    {

        $router = new AltoRouter();

        $router->map('GET', '/', [new \App\Controllers\HomePageController($twig), 'homePage']);
        $router->map('GET', '/posts', [new \App\Controllers\PostsController($twig), 'postsView']);

        $match = $router->match();

        if( is_array($match) && is_callable( $match['target'] ) ) {
            call_user_func_array( $match['target'], $match['params'] );
        } else {
            // no route was matched
            header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
        }


    }
}



