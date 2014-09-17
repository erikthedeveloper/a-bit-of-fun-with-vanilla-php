<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= isset($page['title']) ? $page['title'] : "A Page!" ?></title>
    <!-- Styles -->
    <link rel="stylesheet" media="screen" href="/assets/bootstrap.min.css">
    <!--<link rel="stylesheet" media="screen" href="http://bootswatch.com/yeti/bootstrap.css">-->
</head>
<body>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/partials/main_nav.php' ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/partials/flash_message.php' ?>
<div class="container">