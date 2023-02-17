<?php

// DB connect

require 'connectDb.php';

$pdo->exec("DROP TABLE commentary");

echo 'TABLES COMMENTARY ';

$pdo->exec("DROP TABLE users");

echo ',USERS  ';

$pdo->exec("DROP TABLE posts.php");

echo ',POSTS DELETED SUCCESSFULY ! ';

