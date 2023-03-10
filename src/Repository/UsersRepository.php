<?php

namespace App\Repository;

use App\Entity\UsersEntity;
use App\Exceptions\EntityNotFoundException;
use Exception;
use PDO;

class UsersRepository
{


    private PDO $database;

    public function __construct(PDO $database)
    {
        $this->database = $database;
    }

    /**
     * @return array<UsersEntity>
     * @throws Exception
     */
    public function findAll(): array
    {

        // Récuperation de tous les Utilisateurs

        $sql = ("SELECT * FROM users ORDER BY name DESC ");
        $statement = $this->database->query($sql);
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($users as $user) {
            $result[] = new UsersEntity($user["id"], $user["surname"], $user["name"], $user["pseudo"], $user["picture"], new \DateTime($user["created_at"]), $user["email"], $user["password"], $user["role"], new \DateTime($user["created_at"]));

        }

        return $result;
    }

    /**
     * @throws Exception
     */
    public function findOneById(string $id): UsersEntity
    {
        $sql = ("SELECT id, surname, name, pseudo, picture, birth_date, email, password, role, created_at FROM users WHERE id=?");
        $statement = $this->database->prepare($sql);
        $statement->execute([$id]);
        $user = $statement->fetch();
        return new UsersEntity($user["id"], $user["surname"], $user["name"], $user["pseudo"], $user["picture"], new \DateTime($user["created_at"]), $user["email"], $user["password"], $user["role"], new \DateTime($user["created_at"]));
    }

    /**
     * @throws Exception
     * @return array<UsersEntity>
     */
    public function findByPost(string $postId): array
    {
        $sql = "SELECT users.id, surname, name, pseudo, picture, birth_date, email, password, role, users.created_at FROM users JOIN commentary c on users.id = c.users_id WHERE posts_id=?";
        $statement = $this->database->prepare($sql);
        $statement->execute([$postId]);
        $statement->rowCount();
        if($statement->rowCount() === 0){
            return [];
        }
        $result = [];
        foreach ($statement->fetchAll() as $user){
            $result [] = new UsersEntity($user["id"], $user["surname"], $user["name"], $user["pseudo"], $user["picture"], new \DateTime($user["birth_date"]), $user["email"], $user["password"], $user["role"], new \DateTime($user["created_at"]));
        }
        return $result;



    }


    /**
     * @throws EntityNotFoundException
     */
    public function findByEmailAndPassword(string $email, string $password): UsersEntity
    {
        $sql = ("SELECT * from users WHERE email=? and password=?");
        $statement = $this->database->prepare($sql);
        $statement->execute([$email, $password]);
        $user = $statement->fetch();
        if ($user === false) {
            throw new EntityNotFoundException();
        }
        return new UsersEntity($user["id"], $user["surname"], $user["name"], $user["pseudo"], $user["picture"], new \DateTime($user["created_at"]), $user["email"], $user["password"], $user["role"], new \DateTime($user["created_at"]));
    }


}
