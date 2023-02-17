<?php
// récuperation de l'autoloader
require  dirname(__DIR__) . '../../vendor/autoload.php';

//Utilisation de la librairie FAKER
$faker = Faker\Factory::create('fr_FR');

// Récuperation de la connexion
require 'connectDb.php';

// Récupérer les tables sous forme de tableau
$posts = [];
$commentary = [];
$users = [];


// Désactivation des FOREIGN KEY et nettoyage des tables
$pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
$pdo->exec("TRUNCATE TABLE commentary");
$pdo->exec("TRUNCATE TABLE users");
$pdo->exec("TRUNCATE TABLE posts.php");
$pdo->exec("SET FOREIGN_KEY_CHECKS = 1");


echo 'DataBase Tables clean Successfuly!, ';

// Création de Faux USERS

for($i = 0; $i < 10; $i++){

$hashPassword = password_hash($faker->password, PASSWORD_BCRYPT);
$pdo->exec("INSERT INTO users
            SET surname = '{$faker->firstName($gender = null|'male'|'female')}',
                name = '{$faker->lastName }',
                pseudo = '{$faker->colorName}',
                picture = 'image{$faker->numberBetween($min =1, $max = 25)}.jpg',
                birth_date = '{$faker->date($format = 'Y-m-d', $max = '2001-05-10')}',
                email = '{$faker->email}',
                password = '{$hashPassword}',
                role = 'Suscriber',
                created_at = '{$faker->date($format = "Y-m-d", $max = 'now' )}'
            
            ");

$users[] = $pdo->lastInsertId();

}

echo 'FILLED USERS SUCCESSFULY, ';



// Création d'un ADMIN

$hashPassword = password_hash('Base', PASSWORD_BCRYPT);
$pdo->exec("INSERT INTO users
        SET surname = 'Riso',
            name = 'Nicolas',
            pseudo = 'Actarus13',
            picture = 'image{$faker->numberBetween($min =1, $max = 25)}.jpg',
            birth_date = '1981-08-30',
            email = '{$faker->email}',
            password = '{$hashPassword}',
            role = 'Admin',
            created_at = '{$faker->date($format = "Y-m-d", $max = 'now' )}'
        
        ");

echo 'ADMIN CREATED, ';


// Création de Faux POSTS
for($i = 0; $i < 20; $i++){

    $pdo->exec("INSERT INTO posts.php
                SET title = '{$faker->sentence($nbWords = 8, $variableNbWords = true)}',
                    subtitle = '{$faker->text($maxNbChars = 250)}',
                    content = '{$faker->text($maxNbChars = 400)}',
                    rate = '{$faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 10)}',
                    created_at = '{$faker->date($format = "Y-m-d", $max = 'now' )}'
                
                ");
    
    $posts[] = $pdo->lastInsertId();
    
    }

    echo 'FILLED POST SUCCESSFULY,';



    // Création de Faux COMMENTARY
for($i = 0; $i < 10; $i++){

    $pdo->exec("INSERT INTO commentary
                SET users_id = '{$faker->numberBetween($min =1, $max = 10)}',
                    posts_id = '{$faker->numberBetween($min =1, $max = 20)}',
                    content = '{$faker->text($maxNbChars = 300)}',
                    created_at = '{$faker->date($format = "Y-m-d", $max = 'now' )}',
                    refused_at = '{$faker->date($format = "Y-m-d", $max = '2022-04-25' )}',
                    published = '1',
                    reason = '{$faker->text($maxNbChars = 150)}'
                
                ");
    
    $commentary[] = $pdo->lastInsertId();
    
    }



    echo 'FILLED COMMENTARY SUCCESFULY!';