<?php

$to = "nicolas.riso13@gmail.com";
$subject = "Test utilisation du mail";
$message = "Salut, ceci est un mail de test";
$headers = "Content-type: text/plain; charset=utf-8";
$headers .= "from: nscassidy288@gmail.com";

if(mail($to, $subject, $message, $headers))
    echo 'Envoyé !';
else
    echo 'Erreur envoi';
