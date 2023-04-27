<?php

namespace App\Controllers;

use App\Entity\PostEntity;
use App\Entity\UsersEntity;
use App\Exceptions\AccessDeniedException;
use App\Exceptions\EntityNotFoundException;
use App\Repository\PostsRepository;
use App\Router\Request;
use App\Router\Session;
use App\Validation\CreatePostValidator;
use Exception;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class AdminController
{

    private Environment $twig;
    private PostsRepository $postsRepository;
    private Request $request;


    public function __construct(Environment $twig, Request $request, PostsRepository $postsRepository)
    {
        $this->twig = $twig;
        $this->postsRepository = $postsRepository;
        $this->request = $request;


    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     * @throws Exception
     */
    public function adminManager(): void
    {
        $user = $this->request->getSession()->getUser();
        if ($user === null || !$user->isAdmin()) {
            throw new AccessDeniedException();
        }
        $posts = $this->postsRepository->read();
        echo $this->twig->render('/Admin/adminManager.html.twig', ["posts" => $posts]);
    }


    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     * @throws Exception
     */
    public function createPost(): void
    {
        $user = $this->request->getSession()->getUser();
        if ($user === null || !$user->isAdmin()) {
            throw new AccessDeniedException();
        }
        $postValues = $this->request->getPosts();
        $validator = new CreatePostValidator();
        $violations = $validator->postValidator($postValues);

        if (count($violations) === 0) {

            $postEntity = new PostEntity(null, $postValues['title'], $postValues['subtitle'], $postValues['author'], $postValues['content'], $postValues['userId']);
            $this->postsRepository->save($postEntity);
            $this->request->getSession()->addMessage('Post créé avec succés !');
            header('location: /admin-manager');

            return;
        }

        echo $this->twig->render('/Admin/adminCreatePost.html.twig', ["post" => $postValues, "createPostViolations" => $violations]);

    }


    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     * @throws Exception
     */
    public function updatePost(int $id): void
    {
        $user = $this->request->getSession()->getUser();
        if ($user === null || !$user->isAdmin()) {
            throw new AccessDeniedException();
        }
        $user = $this->request->getSession()->getUser();

        if ($user === null || !$user->isAdmin()) {
            throw new AccessDeniedException();
        }

        try {
            $postEntity = $this->postsRepository->findOneById($id);
        } catch (EntityNotFoundException $e) {
            http_response_code(404);
            return;
        }

        $postValues = $this->request->getPosts();
        $violations = [];

        if ($this->request->getMethod() === 'POST') {
            $validator = new CreatePostValidator();
            $violations = $validator->postValidator($postValues);

            if (count($violations) === 0) {
                $postEntity->setTitle($postValues['title']);
                $postEntity->setSubtitle($postValues['subtitle']);
                $postEntity->setContent($postValues['content']);
                $this->postsRepository->update($postEntity);
                $this->request->getSession()->addMessage('Post modifié avec succés !');
                header('location: /admin-manager');
                return;
            }
        } else {
            $postValues ['title'] = $postEntity->getTitle();
            $postValues ['subtitle'] = $postEntity->getSubtitle();
            $postValues ['content'] = $postEntity->getContent();
        }


        echo $this->twig->render('/Admin/adminUpdatePost.html.twig', ["post" => $postValues, "createPostViolations" => $violations, "postId" => $id]);
    }


    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     * @throws Exception
     */
    public function deletePost(int $id): void
    {
        $user = $this->request->getSession()->getUser();
        if ($user === null || !$user->isAdmin()) {
            throw new AccessDeniedException();
        }
        $post = $this->postsRepository->findOneById($id);
        echo $this->twig->render('/Admin/deletePostPage.html.twig', ["post" => $post]);

    }

    public function deletePostConfirmation(int $id): void
    {
        $user = $this->request->getSession()->getUser();
        if ($user === null || !$user->isAdmin()) {
            throw new AccessDeniedException();
        }
        $this->postsRepository->delete($id);
        $this->request->getSession()->addMessage('Post' . ' ' . $id . ' ' . 'supprimé avec succés');
        header('location: /admin-manager');
    }


}
