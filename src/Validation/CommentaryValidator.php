<?php

namespace App\Validation;

class CommentaryValidator
{
    public function commentValidator(array $postValues): array
    {
        $createPostViolations = array();


        if (empty($postValues['Comment'])) {
            $createPostViolations ['Comment'] [] = "Veuillez renseigner un titre";
        }


        return $createPostViolations;

    }



}
