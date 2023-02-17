<?php

namespace App\Models;

use Exception;
use PDO;

class PostsModel
{
    public function getPosts()
    {


    // Connexion à la base de données
        try {
            $database = new PDO('mysql:host=localhost;dbname=blogphp;charset=utf8', 'root', '1234');
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }


        // Récuperation des Posts
        $statement = $database->query(
            "SELECT id, title, subtitle, content, rate, DATE_FORMAT(created_at, '%d/%m/%Y à %Hh%imin%ss') AS created_at  FROM posts ORDER BY created_at DESC LIMIT 0, 5"
        );
        $posts = [];
        while (($row = $statement->fetch())) {
            $post = [
                'title' => $row['title'],
                'subtitle' => $row['subtitle'],
                'content' => $row['content'],
                'rate' => $row['rate'],
                'created_at' => $row['created_at'],

            ];
            $posts[] = $post;
        }
        return $posts;
    }
}





