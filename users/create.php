<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

// Get form data
$validate_fields = [
    'first_name' => "/\w+/",
    'last_name'  => "/\w+/",
    'email'    => "/\w+/",
    'password' => "/\w+/",
    'password_confirmation' => "/\w+/"
];

foreach ($validate_fields as $key => $pattern) {
    if (!preg_match($pattern, $_POST[$key])) {
        redirect_user("/users/new.php", "Whoops. Looks like you forgot to fill in \"$key\"!");
    }
}

if ($_POST['password_confirmation'] != $_POST['password']) {
    redirect_user("/users/new.php", "Whoops. Your password confirmation didn't match...");
}

$first_name = $_POST['first_name'];
$last_name  = $_POST['last_name'];
$email      = $_POST['email'];
$password   = $_POST['password'];

$encrypted_password = password_hash($password, PASSWORD_BCRYPT);

$user_create_data = compact('first_name', 'last_name', 'email', 'encrypted_password');

$users_id = \MyClasses\Models\User::create($user_create_data);
$user     = \MyClasses\Models\User::getOne($users_id);
\MyClasses\Auth\AuthMaster::logUserInUsingId($user['id']);
// Redirect user
redirect_user('/users/show.php?id=' . $users_id, "Welcome, {$user['first_name']}!");

?>