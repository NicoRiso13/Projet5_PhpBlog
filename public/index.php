<?php


use App\Router\Session;
use Twig\Environment;
use Twig\Extra\String\StringExtension;
use Twig\Loader\FilesystemLoader;

require '../vendor/autoload.php';


$loader = new FilesystemLoader('../templates');
$twig = new Environment($loader, [
//    'cache' => '../cache',
    'cache' => false,]);
$twig->addExtension(new StringExtension());



try {
    $session = new Session();
    $twig->addGlobal('session', $session);
    $request = new \App\Router\Request($_POST, $_GET, $_SERVER, $session);
    $router = new \App\Router\Router();
    $database = new PDO('mysql:host=localhost;dbname=blogphp;charset=utf8', 'root', '1234');
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $router->routes($twig, $database, $request);
}catch(\App\Exceptions\AccessDeniedException $accessDenied){

    echo $twig->render('/Exceptions/erreur404.html.twig');

} catch (Exception $e) {
    echo('Erreur : ' . $e->getMessage());
}
















