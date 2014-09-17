<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

if (!isset($_GET['id'])) {
    //redirect_user('/people/index.php', 'No person found for ID ... or you didn\'t supply one!');
}
$person_id = $_GET['id'];

/** @var PDO $pdo_connection */
$statement = $pdo_connection->prepare('DELETE FROM people WHERE id = :id');
$statement->execute(['id' => $person_id]);

//redirect_user('/people/index.php', "You. Killed. Him. ...");

?>