<?php

namespace App\Repository;

use App\Entity\PostEntity;
use Exception;
use PDO;

class PostsRepository
{
    public function indexPosts()
    {

        // Connexion à la base de données
        try {
            $database = new PDO('mysql:host=localhost;dbname=blogphp;charset=utf8', 'root', '1234');
            $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo ('Erreur : ' . $e->getMessage());
        }



        // Récuperation des Posts
        $sql = "SELECT * FROM posts ORDER BY id LIMIT 0,5";
//            "SELECT id, title, subtitle, author, content, DATE_FORMAT(created_at, '%d/%m/%Y à %Hh%imin%ss') AS created_at  FROM posts ORDER BY id asc LIMIT 0, 5"
//        );

        $requete = $database->query($sql);

        $posts = $requete->fetchAll(PDO::FETCH_ASSOC);


        return $posts;
    }


}






