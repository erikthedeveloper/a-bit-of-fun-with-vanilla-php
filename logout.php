<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

unset($_SESSION['user']);

header("Location: /");
?>