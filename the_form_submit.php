<?php
require_once 'bootstrap.php';
/**
 * @var PDO $pdo_connection
 */
// Get form data
$first_name = $_POST['first_name'];
$last_name  = $_POST['last_name'];
$age        = $_POST['age'];
$pet_name   = $_POST['pet_name'];

// Insert User
$success = $pdo_connection->prepare('INSERT INTO people (first_name, last_name) VALUE (?, ?)')
    ->execute([$first_name, $last_name]);
$people_id = $pdo_connection->lastInsertId();
// Insert Pet
$success = $pdo_connection->prepare('INSERT INTO pets (name) VALUE (?)')
    ->execute([$pet_name]);
$pet_id = $pdo_connection->lastInsertId();
// Associate Owner -> Pet
$success = $pdo_connection->prepare('INSERT INTO people_pets (people_id, pet_id) VALUE (?, ?)')
    ->execute([$people_id, $pet_id]);

// Redirect user
$_SESSION['flash']['message'] = "You have been flashed! " . (string) $foo;
header("Location: /the_form.php");

?>