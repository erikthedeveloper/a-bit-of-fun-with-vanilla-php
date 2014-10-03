<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

$rules = [
    'email'    => "/\w+/",
    'password' => "/\w+/"
];
$validator = new \MyClasses\Validation\Validator();
$validator->validate($rules, $_POST);

$user                = \MyClasses\Models\User::getOneBy('email', $email);
$hashed              = $user['encrypted_password'];
$password_is_correct = password_verify($password, $hashed);

if ($password_is_correct) {
    \MyClasses\Auth\AuthMaster::logUserInUsingId($user['id']);
    redirect_user('/users/index.php', "Log in success. Congratulations, {$user['first_name']}!");
} else {
    redirect_user('/users/login.php', "Wrong password! Try again...");
}

?>