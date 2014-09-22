<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] != "POST") {
    redirect_user('/users/index.php', "Bad method. Bad user!");
}

$user_id = $_POST['id'];
$user = \MyClasses\Models\User::getOne($user_id);
$destroyed = \MyClasses\Models\User::destroy($user_id);

redirect_user('/users/index.php', "You killed {$user['first_name']}!");

?>