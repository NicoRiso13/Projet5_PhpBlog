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
    public function findOneById(int $id): PostEntity
    {
        $sql = ("SELECT * FROM posts WHERE id=?");
        $statement = $this->database->prepare($sql);
        $statement->execute([$id]);
        $post = $statement->fetch();
        return new PostEntity($post["id"], $post["title"], $post["subtitle"], $post["author"], $post["content"], $post['users_id']);

    }

    /**
     * @throws Exception
     * @return array<PostEntity>
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
    public function save(PostEntity $postEntity): void
    {
        $sql = "INSERT INTO posts (users_id, title, subtitle, author, content, created_at) VALUES (?,?,?,?,?,?)";
        $statement = $this->database->prepare($sql);
        $statement->execute([$postEntity->getUserId(), $postEntity->getTitle(),$postEntity->getSubtitle(),$postEntity->getAuthor(),$postEntity->getContent(),$postEntity->getCreatedAt()->format('Y-m-d')]);
        $postEntity->setId($this->database->lastInsertId());
    }



    /**
     * @throws Exception
     */
    public function update(PostEntity $postEntity): void
    {
        $sql = ("UPDATE `posts` SET `users_id`=?,`title`=?,`subtitle`=?,`author`=?,`content`=? WHERE id=?");
        $statement = $this->database->prepare($sql);
        $statement->execute([$postEntity->getUserId(), $postEntity->getTitle(),$postEntity->getSubtitle(),$postEntity->getAuthor(),$postEntity->getContent(),$postEntity->getCreatedAt()->format('Y-m-d')]);
        $postEntity->setId($this->database->lastInsertId());
    }

    public function delete(int $id): void
    {
        $sql = "DELETE FROM posts WHERE id=?";
        $statement = $this->database->prepare($sql);
        $statement->execute([$id]);

    }

    /**
     * @param string $sql
     * @return array<PostEntity>
     * @throws Exception
     */
    public function extracted(string $sql): array
    {
        $statement = $this->database->query($sql);
        $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($posts as $post) {
            $result[] = new PostEntity($post["id"], $post["title"], $post["subtitle"], $post["author"], $post["content"], $post['users_id']);
        }
        return $result;
    }
}
