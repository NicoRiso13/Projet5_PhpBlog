<?php

namespace App\Router;

use App\Entity\CommentaryEntity;
use App\Entity\UsersEntity;

class Session
{
    public function __construct()
    {
        session_start();
    }

    public function getUser(): ?UsersEntity
    {
        if (isset($_SESSION ['user'])) {
            return $_SESSION['user'];
        }
        return null;

    }
    public function getCommentaryStatus(): ?CommentaryEntity
    {
        if (isset($_SESSION ['submission'])) {
            return $_SESSION['submission'];
        }
        return null;

    }

    public function setUser(?UsersEntity $usersEntity): void
    {
        $_SESSION['user'] = $usersEntity;
    }

    public function addMessage(string $message): void
    {
        $_SESSION['messages'] [] = $message;
    }


    /**
     * @return array<string>
     */
    public function getMessages(): array
    {
        if(isset($_SESSION['messages'])){
            $messages = $_SESSION['messages'];
            unset ($_SESSION['messages']);
            return $messages ;
        }
        return [];
    }


}
