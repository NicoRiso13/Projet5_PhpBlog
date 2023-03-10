<?php

namespace App\Validation;

class CreatePostValidator

{

    public function postValidate(array $postValues): array
    {
        $createPostViolations = array();


        if (empty($postValues['title'])) {
            $createPostViolations ['title'] [] = "Veuillez renseigner un titre";
        }
        if (empty($postValues['subtitle'])) {
            $createPostViolations ['subtitle'] [] = "Veuillez renseigner un sous titre";
        }
        if (empty($postValues['content'])) {
            $createPostViolations ['content'] [] = "Veuillez rédiger un contenu";
        }
        if (empty($postValues['author'])) {
            $createPostViolations ['author'] [] = "Veuillez rédiger un contenu";
        }

        if(!empty($postValues['title']) && strlen($postValues['title']) >255 ){
            $createPostViolations ['title'] [] = "Trop de carctères saisies";
        }
        if(!empty($postValues['subtitle']) && strlen($postValues['subtitle']) >255 ){
            $createPostViolations ['subtitle'] [] = "Trop de carctères saisies";
        }

        return $createPostViolations;

    }



}
