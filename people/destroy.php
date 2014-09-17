<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

if (!isset($_GET['id'])) {
    //redirect_user('/people/index.php', 'No person found for ID ... or you didn\'t supply one!');
}
$person_id = $_GET['id'];

$destroyed = \MyClasses\Models\Person::destroy($person_id);

redirect_user('/people/index.php', "You. Killed. Him. ...");

?>