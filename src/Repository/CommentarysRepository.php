<?php

namespace App\Repository;

use App\Entity\CommentaryEntity;
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
     * @throws Exception
     * @return array<CommentaryEntity>
     */
    public function findByPost(int $id): array
    {
        // Récuperation des Commentaires

        $sql = ("SELECT * FROM commentary WHERE commentary.posts_id=?");
        $statement = $this->database->prepare($sql);
        $statement->execute([$id]);
        $commentarys = $statement->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($commentarys as $commentary) {
            $result[] = new CommentaryEntity($commentary['id'], $commentary['content'], new \DateTime($commentary['created_at']), new \DateTime($commentary['refused_at']), $commentary['status'],$commentary['reason'],$commentary['users_id']);

        }

        return $result;
    }

}
