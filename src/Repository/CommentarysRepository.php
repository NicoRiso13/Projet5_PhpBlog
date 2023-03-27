<?php

namespace App\Repository;

use App\Entity\CommentaryEntity;
use App\Exceptions\EntityNotFoundException;
use App\Validation\CommentaryValidator;
use Exception;
use PDO;

class CommentarysRepository
{

    private PDO $database;

    public function __construct(PDO $database)
    {
        $this->database = $database;
    }

    /**
     * @throws EntityNotFoundException
     * @throws Exception
     */
    public function findOneById(int $id): CommentaryEntity
    {
        $sql = ("SELECT * FROM commentarys WHERE id=?");
        $statement = $this->database->prepare($sql);
        $statement->execute([$id]);
        $commentary = $statement->fetch();
        if ($commentary === false) {
            throw new EntityNotFoundException();
        }
        $commentaryEntity = new CommentaryEntity($commentary["id"], $commentary["content"], $commentary["refused_at"], $commentary["status"],$commentary['users_id'],$commentary['posts_id']);
        $commentaryEntity->setCreatedAt(new \DateTime($commentary['created_at']));

        return $commentaryEntity;
    }


    /**
     * @throws Exception
     */
    public function findAll(): array
    {
        $sql = ("SELECT * FROM commentarys ORDER BY created_at DESC ");
        $statement = $this->database->query($sql);
        $commentarys = $statement->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($commentarys as $commentary) {
            $commentaryEntity = new CommentaryEntity($commentary['id'], $commentary['content'], new \DateTime($commentary['refused_at']), $commentary['status'], $commentary['users_id'],$commentary['posts_id']);
            $commentaryEntity->setCreatedAt(new \DateTime($commentary['created_at']));

            $result [] = $commentaryEntity;
        }
        return $result;
    }



    /**
     * @throws Exception
     * @return array<CommentaryEntity>
     */
    public function findByPostValidate(int $id): array
    {
        // Récuperation des Commentaires

        $sql = ("SELECT * FROM commentarys WHERE commentarys.posts_id=? and commentarys.status='validate'");
        $statement = $this->database->prepare($sql);
        $statement->execute([$id]);
        $commentarys = $statement->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($commentarys as $commentary) {
            $result[] = new CommentaryEntity($commentary['id'], $commentary['content'], new \DateTime($commentary['created_at']), $commentary['status'],$commentary['users_id'],$commentary['posts_id']);
        }

        return $result;
    }






    /**
     * @throws Exception
     */
    public function add(CommentaryEntity $commentaryEntity): void
    {
        $sql = "INSERT INTO commentarys (users_id, posts_id, content, created_at, refused_at, status) VALUES (?,?,?,?,?,?) ";
        $statement = $this->database->prepare($sql);
        $statement->execute([$commentaryEntity->getUserId(),$commentaryEntity->getPostId(),$commentaryEntity->getContent(),$commentaryEntity->getCreatedAt()->format('Y-m-d'), $commentaryEntity->getRefusedAt(), $commentaryEntity->getStatus()]);
    }





    /**
     * @param CommentaryEntity $commentaryEntity
     * @return bool
     */
    public function updateStatusCommentary(CommentaryEntity $commentaryEntity): bool
    {
        $sql = "UPDATE commentarys SET users_id=?,posts_id=?,content=?,created_at=?,refused_at=?,status=? WHERE id=?";
        $statement = $this->database->prepare($sql);
        $refusedAt = $commentaryEntity->getRefusedAt();
        return $statement->execute([
            $commentaryEntity->getUserId(),
            $commentaryEntity->getPostId(),
            $commentaryEntity->getContent(),
            $commentaryEntity->getCreatedAt()->format('Y-m-d'),
            $refusedAt !== null ? $refusedAt->format('Y-m-d'): null,
            $commentaryEntity->getStatus(),
            $commentaryEntity->getId(),
        ]);
    }


}
