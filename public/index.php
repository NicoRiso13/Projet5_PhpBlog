<?php


use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require '../vendor/autoload.php';


$loader = new FilesystemLoader('../templates');
$twig = new Environment($loader, [
//    'cache' => '../cache',
    'cache' => false,]);

try {
    $database = new PDO('mysql:host=localhost;dbname=blogphp;charset=utf8', 'root', '1234');
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo ('Erreur : ' . $e->getMessage());
}

$router = new \App\Router\Router();
$router->routes($twig, $database);




