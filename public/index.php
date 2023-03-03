<?php



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
    $database = new PDO('mysql:host=localhost;dbname=blogphp;charset=utf8', 'root', '1234');
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo('Erreur : ' . $e->getMessage());
}

$router = new \App\Router\Router();
$router->routes($twig, $database);





//Traitement formulaire login

if (isset($_POST['email']) &&  isset($_POST['password'])) {
    $users = new \App\Repository\UsersRepository($database);
    foreach ($users as $user) {
        if (
            $user['email'] === $_POST['email'] &&
            $user['password'] === $_POST['password']
        ) {
            $loggedUser = [
                'email' => $user['email'],
            ];
        } else {
            $errorMessage = sprintf('Les informations envoyées ne permettent pas de vous identifier : (%s/%s)',
                $_POST['email'],
                $_POST['password']
            );
        }
    }
}






//Traitement Formulaire d'ajout de commentaire
if (isset($_POST['addCommentary'])) {
    if ($_POST['inputCommentary']) {
        echo "vous avez saisie le commentaire suivant : " . $_POST['inputCommentary'];
    } else {
        echo "vous n'avez rien saisie";
    }

}




