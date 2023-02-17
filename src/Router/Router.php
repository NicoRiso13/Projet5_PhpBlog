<?php

namespace App\Router;

use AltoRouter;
use Twig\Environment;

class Router
{
    public function Routes(Environment $twig )
    {

        $router = new AltoRouter();

        $router->map('GET', '/', [new \App\Controllers\HomePageController($twig), 'HomePage']);
        $router->map('GET', '/posts', [new \App\Controllers\PostsController($twig), 'PostsView']);
        $router->map('GET', '/contact', [new \App\Controllers\ContactControllers($twig), 'Contact']);
        $router->map('GET', '/login', [new \App\Controllers\LoginSubscribe($twig), 'Login']);
//        $router->map('GET', '/login', [new \App\Controllers\LoginSubscribe($twig), 'DetailsPost']);
//        $router->map('GET', '/login', [new \App\Controllers\LoginSubscribe($twig), 'Subscribe']);
//        $router->map('GET', '/login', [new \App\Controllers\LoginSubscribe($twig), 'UserAccount']);
//        $router->map('GET', '/login', [new \App\Controllers\LoginSubscribe($twig), 'ModifyAccount']);
//        $router->map('GET', '/login', [new \App\Controllers\LoginSubscribe($twig), 'AdminPage']);

        $match = $router->match();

        if( is_array($match) && is_callable( $match['target'] ) ) {
            call_user_func_array( $match['target'], $match['params'] );
        } else {
            // no route was matched
            header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
        }


    }
}



