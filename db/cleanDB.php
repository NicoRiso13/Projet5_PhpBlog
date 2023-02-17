<?php

// DB connect
require 'connectDb.php';

$pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
$pdo->exec("TRUNCATE commentary");
echo 'TABLES COMMENTARY ';
$pdo->exec("TRUNCATE users");
echo ',USERS ';
$pdo->exec("TRUNCATE posts.php");
echo ',POSTS DELETED SUCCESSFULY ! ';
$pdo->exec("SET FOREIGN_KEY_CHECKS = 1");

echo "DataBase Cleared !";