<?php

//Db connection

require 'connectDb.php';

//Création de la table "USERS"

$pdo->exec("CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    surname VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    pseudo VARCHAR (255) NOT NULL,
    picture VARCHAR (255) NULL,
    birth_date DATE,
    email VARCHAR(255) NOT NULL,
    password CHAR(255) NOT NULL,
    role ENUM ('Admin','Suscriber') NULL DEFAULT 'Suscriber',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

echo 'Tables : USERS, ';


//Création de la table "POSTS"

$pdo->exec("CREATE TABLE posts.php (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    title VARCHAR(255) NOT NULL,
    subtitle VARCHAR (255) NOT NULL,
    content TEXT NOT NULL,
    rate FLOAT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

echo 'POSTS, ';


//Création de la table "COMMENTARY"

$pdo->exec("CREATE TABLE commentary (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    users_id INT NOT NULL,
    posts_id INT NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    refused_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    published TINYINT NOT NULL,
    reason TEXT NOT NULL,
    FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
    FOREIGN KEY (posts_id) REFERENCES posts.php (id) ON DELETE NO ACTION ON UPDATE NO ACTION

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

echo 'COMMENTARY CREATED SUCCESSFULY ! ';


