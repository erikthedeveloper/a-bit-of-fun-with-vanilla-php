<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] != "POST") {
    redirect_user('/people/index.php', "Bad method. Bad user!");
}

$person_id = $_POST['id'];
$person = \MyClasses\Models\Person::getOne($person_id);
$destroyed = \MyClasses\Models\Person::destroy($person_id);

redirect_user('/people/index.php', "You killed {$person['first_name']}!");

?>