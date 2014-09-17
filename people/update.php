<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';
if (!isset($_POST['id'])) {
    redirect_user('/people/index.php', 'No person found for ID ... or you didn\'t supply one!');
}
$person_id = $_POST['id'];

$person = \MyClasses\Models\Person::getOne($person_id);

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
$success = \MyClasses\Models\Person::update($person_id, $first_name, $last_name, $age);

// Redirect user
$success = $success ? "YES" : json_encode($pdo_connection->errorInfo());
redirect_user("/people/edit.php?id=" . $person_id, "Updated... whatever. Success: " . $success);

?>