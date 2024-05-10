<?php
require 'config.php';

$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

try {
    $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

    return new PDO($dsn, $user, $password, $options);
} catch (PDOException $e) {
    echo $e->getMessage();
}


    
?>