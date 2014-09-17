<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';
if (!isset($_GET['id'])) {
    redirect_user('/people/index.php', 'No person found for ID ... or you didn\'t supply one!');
}
$person_id = $_GET['id'];

/** @var PDO $pdo_connection */
$statement = $pdo_connection->prepare('SELECT * FROM people WHERE id = :id');
$statement->execute(['id' => $person_id]);
$person = $statement->fetch();

// Get form data
$validate_fields = [
    'first_name' => "/\w+/",
    'last_name'  => "/\w+/",
    'age'        => "/\d+/"
];

foreach ($validate_fields as $key => $pattern) {
    if (!preg_match($pattern, $_POST[$key])) {
        redirect_user("/people/edit.php?id=" . $person_id, "Whoops. Looks like you forgot to fill in \"$key\"!");
    }
}

$first_name = $_POST['first_name'];
$last_name  = $_POST['last_name'];
$age        = $_POST['age'];

// Update User
$success   = $pdo_connection->prepare('UPDATE `people` SET first_name = :first_name, last_name = :last_name, age = :age WHERE id = :id')
    ->execute(['first_name' => $first_name, 'last_name' => $last_name, 'age' => $age, 'id' => $person_id]);

// Redirect user
$success = $success ? "YES" : json_encode($pdo_connection->errorInfo());
redirect_user("/people/edit.php?id=" . $person_id, "Updated... whatever. Success: " . $success);

?>