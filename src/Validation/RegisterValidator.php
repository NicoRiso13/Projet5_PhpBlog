<?php

namespace App\Validation;

class RegisterValidator
{

    public function registerValidator(array $userValues): array
    {
        $registerViolations = array();


        if (empty($userValues['surname'])) {
            $registerViolations ['surname'] [] = "Veuillez saisir un nom";
        }
        if (empty($userValues['name'])) {
            $registerViolations ['name'] [] = "Veuillez saisir un prénom";
        }
        if (empty($userValues['pseudo'])) {
            $registerViolations ['pseudo'] [] = "Veuillez saisir un pseudo";
        }
        if (empty($userValues['birthDate'])) {
            $registerViolations ['birthDate'] [] = "Veuillez saisir une date de naissance";
        }
        if (empty($userValues['email'])) {
            $registerViolations ['email'] [] = "Veuillez saisir un email";
        }
        if (empty($userValues['password'])) {
            $registerViolations ['password'] [] = "Veuillez saisir un mot de passe ";
        }

        if(!empty($userValues['surname']) && strlen($userValues['surname']) >255 ){
            $registerViolations ['surname'] [] = "Trop de carctères saisies";
        }
        if(!empty($userValues['name']) && strlen($userValues['name']) >255 ){
            $registerViolations ['name'] [] = "Trop de carctères saisies";
        }

        return $registerViolations;

    }

}
