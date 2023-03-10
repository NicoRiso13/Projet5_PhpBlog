<?php

namespace App\Router;

class Request
{


    private array $posts;
    private array $queryParams;
    private array $headers;
    private Session $session;

    public function __construct(array $posts, array $queryParams, array $headers, Session $session)
    {
        $this->posts = $posts;
        $this->queryParams = $queryParams;
        $this->headers = $headers;
        $this->session = $session;
    }

    /**
     * @return array
     */
    public function getPosts(): array
    {
        return $this->posts;
    }

    /**
     * @return array
     */
    public function getQueryParams(): array
    {
        return $this->queryParams;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @return Session
     */
    public function getSession(): Session
    {
        return $this->session;
    }


}
