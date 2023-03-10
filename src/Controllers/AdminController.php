<?php

namespace App\Controllers;

use App\Entity\PostEntity;
use App\Exceptions\EntityNotFoundException;
use App\Repository\PostsRepository;
use App\Router\Request;
use App\Validation\CreatePostValidator;
use App\Validation\UserLoginValidator;
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
        $posts = $this->postsRepository->read();
        echo $this->twig->render('/Admin/adminManager.html.twig', ["posts" => $posts]);
    }




    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function createPost(): void
    {

        $postValues = $this->request->getPosts();
        $validator = new CreatePostValidator();
        $violations = $validator->postValidate($postValues);
        if(count($violations) === 0) {
            try {
                $postEntity = new PostEntity(null, $postValues['title'], $postValues['subtitle'], $postValues['author'], $postValues['content']);
                $this->postsRepository->save($postEntity);
                $this->request->getSession()->addMessage('Post créé avec succés !');
                header('location: /admin-manager');
                return;
            } catch (EntityNotFoundException $e) {
                $violations ['errors'] [] = "Email ou Password invalide";
            }
        }
        echo $this->twig->render('/Admin/adminCreatePost.html.twig',["post" => $postValues, "createPostViolations"=>$violations]);
    }





    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     * @throws Exception
     */

    public function modifyPost(string $id): void
    {
        $postValues = $this->request->getPosts();
        $post = $this->postsRepository->update($id);
        var_dump($post);
        echo $this->twig->render('/Admin/adminModifyPost.html.twig', ["postValues" => $postValues]);
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function deletePost(string $id): void
    {
        $post = $this->postsRepository->findOneById($id);
        echo $this->twig->render('/Admin/deletePostPage.html.twig', ["post" => $post]);

    }

    public function deletePostConfirmation(string $id): void
    {
        $this->postsRepository->delete($id);
        $this->request->getSession()->addMessage('Post'.' '.$id.' '.'supprimé avec succés');
        header('location: /admin-manager');
    }






}
