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
//var_dump(compact('password_is_correct', 'user', 'password')); exit;

if ($password_is_correct) {
    $_SESSION['user']['first_name'] = $user['first_name'];
    redirect_user('/users/login.php', "Password correct. Congratulations...");
} else {
    redirect_user('/users/login.php', "Wrong password! Try again...");
}

?>