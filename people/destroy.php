<?php
require_once 'bootstrap.php';
/**
 * @var PDO $pdo_connection
 */


// Redirect user
$_SESSION['flash']['message'] = "Submitted. Whatever.";
header("Location: /people/index.php");

?>