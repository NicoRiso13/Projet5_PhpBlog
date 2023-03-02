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
     * @throws Exception
     */
    public function findAll(): array
    {

        // Récuperation des Posts

        $sql = ("SELECT * FROM posts ORDER BY created_at DESC ");
        $statement = $this->database->query($sql);
        $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($posts as $post) {
            $result[] = new PostEntity($post["id"], $post["title"], $post["subtitle"], $post["author"], $post["content"], new \DateTime($post["created_at"]));
        }
        return $result;
    }

    /**
     * @throws Exception
     */
    public function findOneById(string $id): PostEntity
    {
        $sql = ("SELECT id, title, subtitle, author, content, created_at FROM posts WHERE id=?");
        $statement = $this->database->prepare($sql);
        $statement->execute([$id]);
        $post = $statement->fetch();
        return new PostEntity($post["id"], $post["title"], $post["subtitle"], $post["author"], $post["content"], new \DateTime($post["created_at"]));
    }
}
