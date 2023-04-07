<?php

namespace App\Validation;

class UserLoginValidator
{

    public function validate(array $values): array
    {
        $violations = array();

        if(!empty($values['loginEmail']) && !filter_var($values['loginEmail'],FILTER_VALIDATE_EMAIL)){
            $violations ['loginEmail'] [] = "Email incorrect !!";
        }
        if(!empty($values['loginEmail']) && strlen($values['loginEmail']) >255 ){
            $violations ['loginEmail'] [] = "Trop de carctères saisies";
        }
        if(!empty($values['loginPassword']) && strlen($values['loginPassword']) >255 ){
            $violations ['loginPassword'] [] = "Trop de carctères saisies";
        }
        if (empty($values['loginEmail'])) {
            $violations ['loginEmail'] [] = "Veuillez saisir un email";
        }
        if (empty($values['loginPassword'])) {
            $violations ['loginPassword'] [] = "Veuillez saisir un mot de passe";
        }

        return $violations;

    }

}
