<?php

$dsn = "mysql:host=localhost;dbname=cs4000_fun";
$pdo = new PDO($dsn, "homestead", "secret");

$host = "localhost";
$user = "homestead";
$password = "secret";
$database = "cs4000_fun";
$connection = new mysqli($host, $user, $password, $database, 3306);

?>