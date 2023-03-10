<?php

namespace App\Repository;

use App\Entity\PostEntity;
use DateTime;
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
        // Récuperation des Posts avec date de creation par ordre Croisssant

        $sql = ("SELECT * FROM posts ORDER BY created_at DESC ");
        return $this->extracted($sql);
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

    /**
     * @throws Exception
     */
    public function save(PostEntity $postEntity): void
    {
        $sql = "INSERT INTO posts (title, subtitle, author, content, created_at) VALUES (?,?,?,?,?)";
        $statement = $this->database->prepare($sql);
        $statement->execute([$postEntity->getTitle(),$postEntity->getSubtitle(),$postEntity->getAuthor(),$postEntity->getContent(),$postEntity->getCreatedAt()->format('Y-m-d')]);
        $postEntity->setId($this->database->lastInsertId());
    }


    /**
     * @throws Exception
     */
    public function read(): array
    {
        // Récuperation des Posts avec ID par ordre Croisssant

        $sql = ("SELECT * FROM posts ORDER BY id ASC ");
        return $this->extracted($sql);
    }


    /**
     * @throws Exception
     */
    public function update(string $id): PostEntity
    {
        $sql = ("UPDATE posts SET  title=:title ,subtitle=:subtitle, author=:author, content=:content, created_at=:created_at WHERE id=:id");
        $statement = $this->database->query($sql);
        $statement->execute([$id]);


        return new PostEntity($post["id"], $post["title"], $post["subtitle"], $post["author"], $post["content"], new \DateTime($post["created_at"]));

    }

    public function delete(string $id): void
    {
        $sql = "DELETE FROM posts WHERE id=?";
        $statement = $this->database->prepare($sql);
        $statement->execute([$id]);

    }

    /**
     * @param string $sql
     * @return array
     * @throws Exception
     */
    public function extracted(string $sql): array
    {
        $statement = $this->database->query($sql);
        $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($posts as $post) {
            $result[] = new PostEntity($post["id"], $post["title"], $post["subtitle"], $post["author"], $post["content"], new \DateTime($post["created_at"]));
        }
        return $result;
    }
}
