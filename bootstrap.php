<?php
session_start();
$display_user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Anonymous';

$dsn            = "mysql:host=localhost;dbname=cs4000_fun";
$pdo_connection = new PDO($dsn, "homestead", "secret");

$host              = "localhost";
$user              = "homestead";
$password          = "secret";
$database          = "cs4000_fun";
$mysqli_connection = new mysqli($host, $user, $password, $database, 3306);