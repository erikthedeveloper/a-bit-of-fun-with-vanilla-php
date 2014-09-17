<?php
$database = [
    'host'     => "localhost",
    'user'     => "homestead",
    'password' => "secret",
    'database' => "cs4000_fun"
];

$dsn               = "mysql:host=" . $database['host'] . ";dbname=" . $database['database'];
$pdo_connection    = new PDO($dsn, "homestead", "secret");
//$mysqli_connection = new mysqli($database['host'], $database['user'], $database['password'], $database['database'], 3306);