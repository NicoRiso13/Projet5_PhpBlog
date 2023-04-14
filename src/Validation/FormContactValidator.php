<?php

namespace App\Validation;

class FormContactValidator
{
    public function contactValidator(array $formValues): array
    {
        $formContactValidations = array();


        if (empty($formValues['surname'])) {
            $formContactValidations ['surname'] [] = "Veuillez renseigner un nom";
        }
        if (!empty($formValues['surname']) && preg_match('/[^a-zA-zÀ-ú]/', $formValues['surname'])) {
            $formContactValidations ['surname'] [] = "Veuillez renseigner un nom valide";
        }
        if (empty($formValues['name'])) {
            $formContactValidations ['name'] [] = "Veuillez renseigner un prénom";
        }
        if (!empty($formValues['name']) && preg_match('/[^a-zA-zÀ-ú]/', $formValues['name'])) {
            $formContactValidations ['name'] [] = "Veuillez renseigner un nom valide";
        }

        if (empty($formValues['email'])) {
            $formContactValidations ['email'] [] = "Veuillez renseigner un email";
        }
        if (empty($formValues['message'])) {
            $formContactValidations ['message'] [] = "Veuillez rédiger un message";
        }
        if (!empty($formValues['message']) && preg_match('/[^a-zA-z0-9À-ú,!?:. ]/', $formValues['message'])) {
            $formContactValidations ['message'] [] = "Les caractères speciaux ne sont pas autorisés";
        }

        if (!empty($formValues['surname']) && strlen($formValues['surname']) > 50) {
            $formContactValidations ['surname'] [] = "Trop de caractères saisis";
        }
        if (!empty($formValues['name']) && strlen($formValues['name']) > 50) {
            $formContactValidations ['name'] [] = "Trop de caractères saisis";
        }

        return $formContactValidations;
    }
}
