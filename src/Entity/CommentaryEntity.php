<?php

namespace App\Entity;

use DateTime;

class CommentaryEntity
{

    private ?int $id;
    private string $content;
    private datetime $createdAt;
    private ?datetime $refusedAt;
    private string $status;
    private int $userId;
    private int $postId;
    private UsersEntity $usersEntity;


    /**
     * @param ?int $id
     * @param string $content
     * @param DateTime|null $refusedAt
     * @param string $status
     * @param int $userId
     * @param int $postId
     */
    public function __construct(?int $id, string $content, ?DateTime $refusedAt, string $status, int $userId, int $postId)
    {
        $this->id = $id;
        $this->content = $content;
        $this->createdAt = new DateTime();
        $this->refusedAt = $refusedAt;
        $this->status = $status;
        $this->userId = $userId;
        $this->postId = $postId;
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
     * @return string
     */




    /**
     * @return int
     */
    public function getUserId(): int
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
     * @return int
     */
    public function getPostId(): int
    {
        return $this->postId;
    }

    /**
     * @param int $postId
     */
    public function setPostId(int $postId): void
    {
        $this->postId = $postId;
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

    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return DateTime
     */
    public function getRefusedAt(): ?DateTime
    {
        return $this->refusedAt;
    }

    /**
     * @param DateTime $refusedAt
     */
    public function setRefusedAt(DateTime $refusedAt): void
    {
        $this->refusedAt = $refusedAt;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return bool
     */
    public function isValidate(): bool
    {
        return $this->status === 'validate';
    }

    /**
     * @return bool
     */
    public function isRefused(): bool
    {
        return $this->status === 'refused';
    }

    /**
     * @return bool
     */
    public function inSubmission(): bool
    {
        return $this->status === 'submission';
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }





}
