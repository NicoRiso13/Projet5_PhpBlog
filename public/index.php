<?php


use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require '../vendor/autoload.php';


$loader = new FilesystemLoader('../templates');
$twig = new Environment($loader, [
//    'cache' => '../cache',
    'cache' => false,]);



$router = new \App\Router\Router();
$router->Routes($twig);




