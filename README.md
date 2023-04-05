# Projet5_BLOG PHP

## Ce projet à pour but de créer notre premier blog en php incluant les fonctionnalités suivantes :


#### En tant qu'Utilisateur il permet d'accéder à :

 - Un système d'authentification et d'inscription d'un utilisateur
 - Un accès à tout les Posts disponibles
 - Un détail de chaque Post
 - La possibilité à l'utilisateur d'ajouter un commentaire
 - Un formulaire de contact
 - La possibilité de télécharger un CV

#### En tant qu'Administrateur il offre:

 - La possibilité de Créer, Modifier ou Supprimer un post
 - Un système permettant de valider les commentaires saisies par les utilisateurs 

## Pré-requis :

 - PHPStorm ( https://www.jetbrains.com/fr-fr/phpstorm/download/#section=windows )
 - Composer ( https://getcomposer.org/download/ )
 - Wampserver ( https://www.wampserver.com/ )
 - Git ( https://git-scm.com/downloads )


## Pour commencer

### Installer PHPStorm & Configurer Git

Pour les différents projets de développement au GInfo on utilise PHPStorm qui est un logiciel présentant un bon nombre de fonctionnalités intéressantes (même si on en utilise même pas 10%) et pour lequel on a des licences étudiantes.

### Créer un compte JetBrains & Installer PHPStorm

Tout commence ici, avec votre mail Centrale : https://www.jetbrains.com/shop/eform/students
Une fois l'inscription effectuée, téléchargez PHPStorm et installer le. (Il est disponible pour toutes les plateformes)

### Configurer PHPStorm pour l'utilisation avec git
Git est l'outil que nous utilisons pour développer en équipe. Mais il nécessite un peu de configuration pour que l'intégration avec PHPStorm fonctionne parfaitement.

#### Sous Windows 10 :
*Installer Git*

Il faut commencer par installer Git en laissant tout par défaut.

Installer OpenSSH

OpenSSH est un outils sous Windows 10 permettant les connexions à distance en utilisant le protocole SSH.

Pour installer OpenSSH :

Ouvrez les Paramètres de votre ordinateur, séléctionnez Applications > Applications et fonctionnalités, puis Fonctionnalités facultatives
Parcourez la liste pour voir si OpenSSH est déjà installé. Si ce n’est pas le cas, sélectionnez Ajouter une fonctionnalité en haut de la page, puis recherchez OpenSSH Client et cliquez sur Installer.
Une fois l’installation terminée, revenez à Applications > Applications et fonctionnalités et Fonctionnalités facultatives. Vous devriez voir OpenSSH dans la liste.

Générer une paire de clé

Pour générer la paire de clé, ouvrez le PowerShell ou le cmd de votre ordinateur puis exécutez :

    ssh-keygen
On vous demandera ensuite où vous voulez sauvegarder votre paire de clés puis un mot de passe. Vous pouvez de ne pas mettre de mot de passe mais ce n'est pas recommandé.

Une fois vos clés générées, vous pourrez les retrouver à l'emplacement choisi.






