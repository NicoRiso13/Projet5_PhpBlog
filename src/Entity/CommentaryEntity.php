<?php

namespace App\Entity;

use DateTime;

class CommentaryEntity
{

    private int $id;
    private string $content;
    private datetime $createdAt;
    private datetime $refusedAt;
    private string $reason;

    /**
     * @param int $id
     * @param string $content
     * @param DateTime $createdAt
     * @param DateTime $refusedAt
     * @param string $reason
     */
    public function __construct(int $id, string $content, DateTime $createdAt, DateTime $refusedAt, string $reason)
    {
        $this->id = $id;
        $this->content = $content;
        $this->createdAt = $createdAt;
        $this->refusedAt = $refusedAt;
        $this->reason = $reason;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
    public function getRefusedAt(): DateTime
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
    public function getReason(): string
    {
        return $this->reason;
    }

    /**
     * @param string $reason
     */
    public function setReason(string $reason): void
    {
        $this->reason = $reason;
    }


}