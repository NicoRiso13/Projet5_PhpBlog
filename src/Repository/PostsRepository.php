<?php

namespace App\Repository;

use App\Entity\PostEntity;
use Exception;
use PDO;

class PostsRepository
{
    private PDO $database;

    public function __construct(PDO $database)
    {

        $this->database = $database;
    }

    /**
     * @return array<PostEntity>
     */
    public function indexPosts():array
    {


        // Récuperation des Posts
        $sql = "SELECT * FROM posts ORDER BY created_at DESC ";
//            "SELECT id, title, subtitle, author, content, DATE_FORMAT(created_at, '%d/%m/%Y à %Hh%imin%ss') AS created_at  FROM posts ORDER BY id asc LIMIT 0, 5"
//        );

        $requete = $this->database->query($sql);
        $posts = $requete->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($posts as $post) {
            $result[] = new PostEntity($post["id"], $post["title"], $post["subtitle"], $post["author"], $post["content"], new \DateTime($post["created_at"]));

        }


        return $result;
    }


}






