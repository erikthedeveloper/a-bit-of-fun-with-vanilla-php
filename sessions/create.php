<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

// Get form data
$validate_fields = [
    'email'    => "/\w+/",
    'password' => "/\w+/"
];

foreach ($validate_fields as $key => $pattern) {
    if (!preg_match($pattern, $_POST[$key])) {
        redirect_user("/users/login.php", "Whoops. Looks like you forgot to fill in \"$key\"!");
    }
}

$email    = $_POST['email'];
$password = $_POST['password'];

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