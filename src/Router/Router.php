<?php

namespace App\Router;

use AltoRouter;
use App\Controllers\AdminController;
use App\Controllers\CommentarysController;
use App\Controllers\ContactControllers;
use App\Controllers\PostController;
use App\Controllers\UserController;
use App\Entity\UsersEntity;
use App\Repository\CommentarysRepository;
use App\Repository\PostsRepository;
use App\Repository\UsersRepository;
use Twig\Environment;

class Router
{

    public function routes(Environment $twig, \PDO $database, Request $request): void
    {

        $router = new AltoRouter();
        $contactController = new ContactControllers($twig, $request);
        $commentarysController = new CommentarysController(new CommentarysRepository($database),$request);
        $postsRepository = new PostsRepository($database);
        $postsController = new PostController($twig ,$postsRepository, new CommentarysRepository($database), new UsersRepository($database));
        $userController = new UserController($twig, $request ,new UsersRepository($database));
        $adminController = new AdminController($twig, $request, $postsRepository);
        $homePageController = new \App\Controllers\HomePageController($twig);




        $router->map('GET', '/', [$homePageController, 'homePage']);
        $router->map('GET|POST', '/login', [$userController, 'login']);
        $router->map('GET|POST', '/logout', [$userController, 'logout']);
        $router->map('GET|POST', '/register', [$userController, 'createUser']);
        $router->map('GET', '/posts', [$postsController, 'postsView']);
        $router->map('GET', '/posts/[i:id]', [$postsController, 'postDetails']);
        $router->map('GET|POST', '/create-post', [$adminController, 'createPost']);
        $router->map('GET|POST', '/update-post/[i:id]', [$adminController, 'updatePost']);
        $router->map('GET|POST', '/update-post/[i:id]/confirmation', [$adminController, 'updatePostConfirmation']);
        $router->map('GET|POST', '/delete-post/[i:id]', [$adminController, 'deletePost']);
        $router->map('GET|POST', '/delete-post/[i:id]/confirmation', [$adminController, 'deletePostConfirmation']);
        $router->map('GET|POST', '/add-commentary', [$commentarysController, 'addCommentary']);
        $router->map('GET', '/admin-manager', [$adminController, 'adminManager']);
        $router->map('GET|POST', '/contact', [$contactController, 'contact']);

        $match = $router->match();

        if( is_array($match) && is_callable( $match['target'] ) ) {
            call_user_func_array( $match['target'], $match['params'] );
        } else {
            // no route was matched
            header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
        }


    }
}
