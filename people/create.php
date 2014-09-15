<?php
require_once 'bootstrap.php';
/**
 * @var PDO $pdo_connection
 */

// Get form data
$validate_fields = [
    'first_name' => "/\w+/",
    'last_name'  => "/\w+/",
    'age'        => "/\d+/",
    'pet_name'   => "/\w+/"
];

foreach ($validate_fields as $key => $pattern) {
    if (!preg_match($pattern, $_POST[$key])) {
        $_SESSION['flash']['message'] = "Whoops. Looks like you forgot to fill in \"$key\"!";
        header("Location: /register_pet.php");
        exit;
    }
}

$first_name = $_POST['first_name'];
$last_name  = $_POST['last_name'];
$age        = $_POST['age'];
$pet_name   = $_POST['pet_name'];

// Insert User
$success   = $pdo_connection->prepare('INSERT INTO people (first_name, last_name, age) VALUE (?, ?, ?)')
    ->execute([$first_name, $last_name, $age]);
$people_id = $pdo_connection->lastInsertId();

// Redirect user
$_SESSION['flash']['message'] = "Submitted. Whatever.";
header("Location: /people/index.php");

?>