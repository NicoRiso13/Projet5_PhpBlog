<?php

namespace App\Controllers;

use App\Entity\PostEntity;
use App\Entity\UsersEntity;
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
        $violations = $validator->postValidator($postValues);

        if (count($violations) === 0) {
            try {
                $postEntity = new PostEntity(null, $postValues['title'], $postValues['subtitle'], $postValues['author'], $postValues['content'], $postValues['userId']);
                $this->postsRepository->save($postEntity);
                $this->request->getSession()->addMessage('Post créé avec succés !');
                header('location: /admin-manager');
                return;
            } catch (EntityNotFoundException $e) {
                $violations ['errors'] [] = "Données de formulaire incorrecte";
            }

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

        $post = $this->postsRepository->findOneById($id);
        echo $this->twig->render('/Admin/adminUpdatePost.html.twig', ["post" => $post]);


//        $this->postsRepository->findOneById($id);
//        $postValues = $this->request->getPosts();
//        $validator = new CreatePostValidator();
//        $violations = $validator->postValidate($postValues);
//        if(count($violations) === 0) {
//            try {
//
//                var_dump($postValues);
//                $postEntity = new PostEntity(null, $postValues['title'], $postValues['subtitle'], $postValues['author'], $postValues['content'], $postValues['usersId']);
//                $this->postsRepository->update($id);
//                $this->request->getSession()->addMessage('Post mis à jour avec succés !');
//                header('location: /admin-manager');
//                return ($postEntity);
//            } catch (EntityNotFoundException $e) {
//                $violations ['errors'] [] = "Données de formulaire incorrecte";
//            }
//        }
//
//        echo $this->twig->render('/Admin/adminUpdatePost.html.twig',["post" => $postValues, "createPostViolations"=>$violations]);


    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     * @throws Exception
     */
    public function updatePostConfirmation(): void
    {
        $postValues = $this->request->getPosts();
        $postEntity = new PostEntity(null, $postValues['title'], $postValues['subtitle'], $postValues['author'], $postValues['content'], $postValues['userId']);
        $this->postsRepository->update($postEntity);
        $this->request->getSession()->addMessage('Post modifié avec succés');
        header('location: /admin-manager');


    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     * @throws Exception
     */
    public function deletePost(int $id): void
    {
        $post = $this->postsRepository->findOneById($id);
        echo $this->twig->render('/Admin/deletePostPage.html.twig', ["post" => $post]);

    }

    public function deletePostConfirmation(int $id): void
    {
        $this->postsRepository->delete($id);
        $this->request->getSession()->addMessage('Post' . ' ' . $id . ' ' . 'supprimé avec succés');
        header('location: /admin-manager');
    }


}
