<?php

namespace App\Entity;


use Cassandra\Date;
use DateTime;

class UsersEntity
{

private ?int $id;
private string $surname;
private string $name;
private string $pseudo;

private string $birthDate;
private string $email;
private string $password;
private string $role;
private dateTime $createdAt;

    /**
     * @param int|null $id
     * @param string $surname
     * @param string $name
     * @param string $pseudo
     * @param string $birthDate
     * @param string $email
     * @param string $password
     */
    public function __construct(?int $id, string $surname, string $name, string $pseudo, string $birthDate, string $email, string $password)
    {
        $this->id = $id;
        $this->surname = $surname;
        $this->name = $name;
        $this->pseudo = $pseudo;
        $this->birthDate = $birthDate;
        $this->email = $email;
        $this->password = $password;
        $this->role = "user";
        $this->createdAt = new DateTime();
    }



    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }



    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     */
    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    /**
     * @param string $pseudo
     */
    public function setPseudo(string $pseudo): void
    {
        $this->pseudo = $pseudo;
    }

    /**
     * @return string
     */
    public function getBirthDate(): string
    {
        return $this->birthDate;
    }

    /**
     * @param string $birthDate
     */
    public function setBirthDate(string $birthDate): void
    {
        $this->birthDate = $birthDate;
    }



    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    /**
     * @param string $role
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(): DateTime
    {
        return $this->createdAt;
    }


}
