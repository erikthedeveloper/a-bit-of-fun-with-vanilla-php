<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

$rules = [
    'email'    => ["email"],
    'password' => ["not_empty"]
];
$validator = new \MyClasses\Validation\Validator();
$validator->validate($rules, $_POST);
$validator->redirectWithErrorsIfFailed('/users/login.php');

$user                = \MyClasses\Models\User::getOneBy('email', $_POST['email']);
$hashed              = $user['encrypted_password'];
$password_is_correct = password_verify($_POST['password'], $hashed);

if ($password_is_correct) {
    \MyClasses\Auth\AuthMaster::logUserInUsingId($user['id']);
    redirect_user('/users/index.php', "Log in success. Congratulations, {$user['first_name']}!");
} else {
    redirect_user('/users/login.php', "Wrong password! Try again...");
}

?>