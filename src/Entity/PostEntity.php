<?php

namespace App\Entity;



use DateTime;

class PostEntity
{
    private ?int $id;
    private string $title;
    private string $subtitle;

    private string $author;
    private string $content;

    private ?int $userId;


    private UsersEntity $usersEntity;
    private DateTime $createdAt;

    public function __construct(?int $id, string $title, string $subtitle, string $author, string $content, ?int $userId )
    {
        $this->id = $id;
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->author = $author;
        $this->content = $content;
        $this->createdAt = new DateTime();
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return UsersEntity
     */
    public function getUsersEntity(): UsersEntity
    {
        return $this->usersEntity;
    }

    /**
     * @param UsersEntity $usersEntity
     */
    public function setUsersEntity(UsersEntity $usersEntity): void
    {
        $this->usersEntity = $usersEntity;
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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getSubtitle(): string
    {
        return $this->subtitle;
    }

    /**
     * @param string $subtitle
     */
    public function setSubtitle(string $subtitle): void
    {
        $this->subtitle = $subtitle;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @param string $author
     */
    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
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
