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
            $result[] = new UsersEntity($user["id"], $user["surname"], $user["name"], $user["pseudo"], ($user["birthDate"]), $user["email"], $user["password"], $user["role"], new \DateTime($user["created_at"]));

        }

        return $result;
    }

    /**
     * @throws Exception
     */
    public function findOneById(int $id): UsersEntity
    {
        $sql = ("SELECT id, surname, name, pseudo, birth_date, email, password, role, created_at FROM users WHERE id=?");
        $statement = $this->database->prepare($sql);
        $statement->execute([$id]);
        $user = $statement->fetch();
        return new UsersEntity($user['id'], $user['surname'], $user['name'], $user['pseudo'],$user['birth_date'], $user['email'], $user['password'], $user['role']);
    }


    /**
     * @throws EntityNotFoundException
     * @throws Exception
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
        return new UsersEntity($user['id'], $user['surname'], $user['name'], $user['pseudo'], ($user['birth_date']), $user['email'], $user['password']);
    }

    public function findByRole(string $role): UsersEntity
    {
        $sql = ("SELECT role from users WHERE id=? ");
        $statement = $this->database->prepare($sql);
        $statement->execute([$role]);
        $user = $statement->fetch();
        if ($user === false) {
            throw new EntityNotFoundException();
        }
        return new UsersEntity($user['id'], $user['surname'], $user['name'], $user['pseudo'], ($user['birth_date']), $user['email'], $user['password'], $user['role']);
    }

    Public function register(UsersEntity $usersEntity): void
    {
        $sql = "INSERT INTO users (id,surname, name, pseudo, birth_date, email, password, role, created_at) VALUES (?,?,?,?,?,?,?,?,?)";
        $statement = $this->database->prepare($sql);
        $statement->execute([$usersEntity->getId(),$usersEntity->getSurname(),$usersEntity->getName(),$usersEntity->getPseudo(),$usersEntity->getBirthDate(), $usersEntity->getEmail(), $usersEntity->getPassword(), $usersEntity->getRole(),$usersEntity->getCreatedAt()->format('Y-m-d')]);
        $statement->errorInfo();
        $usersEntity->setId($this->database->lastInsertId());

    }


}
