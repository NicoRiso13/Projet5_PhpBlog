<?php

namespace App\Repository;

use App\Entity\PostEntity;
use App\Exceptions\EntityNotFoundException;
use Exception;
use Faker\Core\DateTime;
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
     * @throws EntityNotFoundException
     */
    public function findOneById(int $id): PostEntity
    {
        $sql = ("SELECT * FROM posts WHERE id=?");
        $statement = $this->database->prepare($sql);
        $statement->execute([$id]);
        $post = $statement->fetch();
        if ($post === false) {
            throw new EntityNotFoundException();
        }
        $postEntity = new PostEntity($post['id'], $post['title'], $post['subtitle'], $post['author'], $post['content'], $post['users_id']);
        $postEntity->setCreatedAt(new \DateTime($post['created_at']));

        return $postEntity;
    }

    /**
     * @return array<PostEntity>
     * @throws Exception
     */
    public function read(): array
    {
        // Récuperation des Posts avec ID par ordre Croisssant

        $sql = ("SELECT * FROM posts ORDER BY id ");
        return $this->extracted($sql);
    }

    /**
     * @throws Exception
     */
    public function save(PostEntity $postEntity): void
    {
        $sql = "INSERT INTO posts (users_id, title, subtitle, author, content, created_at) VALUES (?,?,?,?,?,?)";
        $statement = $this->database->prepare($sql);
        $statement->execute([$postEntity->getUserId(), $postEntity->getTitle(), $postEntity->getSubtitle(), $postEntity->getAuthor(), $postEntity->getContent(), $postEntity->getCreatedAt()->format('Y-m-d')]);
        $postEntity->setId($this->database->lastInsertId());
    }


    /**
     * @throws Exception
     */
    public function update(PostEntity $postEntity): bool
    {
        $sql = ('UPDATE posts SET users_id=?,title=?,subtitle=?,author=?,content=?,created_at=? WHERE id=?');
        $statement = $this->database->prepare($sql);
        return $statement->execute([
            $postEntity->getUserId(),
            $postEntity->getTitle(),
            $postEntity->getSubtitle(),
            $postEntity->getAuthor(),
            $postEntity->getContent(),
            $postEntity->getCreatedAt()->format('Y-m-d'),
            $postEntity->getId(),

        ]);
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
            $postEntity = new PostEntity($post['id'], $post['title'], $post['subtitle'], $post['author'], $post['content'], $post['users_id']);
            $postEntity->setCreatedAt(new \DateTime($post['created_at']));
            $result [] = $postEntity;
        }
        return $result;
    }
}
