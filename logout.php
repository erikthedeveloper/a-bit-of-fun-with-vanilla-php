<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

\MyClasses\Auth\AuthMaster::logOut();

redirect_user('/', 'You have been logged out');
?>