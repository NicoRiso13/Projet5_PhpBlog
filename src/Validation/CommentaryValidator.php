<?php

namespace App\Validation;

class CommentaryValidator
{
    public function commentValidator(array $commentValues): array
    {
        $createPostViolations = array();

        if (empty($commentValues['comment'])) {
            $createPostViolations ['comment'] [] = "Veuillez renseigner un contenu";
        }

        return $createPostViolations;

    }



}
