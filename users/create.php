<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

$rules = [
    'first_name'            => ['not_empty'],
    'last_name'             => ['not_empty'],
    'email'                 => ['not_empty'],
    'password'              => ['not_empty'],
    'password_confirmation' => ['not_empty']
];

$validator = new \MyClasses\Validation\Validator();
$validator->validate($rules, $_POST);
$validator->redirectWithErrorsIfFailed('/users/new.php');
if ($_POST['password'] != $_POST['password_confirmation'])
    redirect_user("/users/new.php", "Whoops. Your password confirmation didn't match...");

$encrypted_password = password_hash($_POST['password'], PASSWORD_BCRYPT);

$user_create_data = [
    'first_name'         => $_POST['first_name'],
    'last_name'          => $_POST['last_name'],
    'email'              => $_POST['email'],
    'encrypted_password' => $encrypted_password
];

$users_id = \MyClasses\Models\User::create($user_create_data);
$user     = \MyClasses\Models\User::getOne($users_id);
\MyClasses\Auth\AuthMaster::logUserInUsingId($user['id']);

redirect_user('/users/show.php?id=' . $users_id, "Welcome, {$user['first_name']}!");

?>