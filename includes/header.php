<?php
include_once 'bootstrap.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= isset($page['title']) ? $page['title'] : "A Page!" ?></title>
    <!-- Styles -->
    <link rel="stylesheet" media="screen" href="/assets/bootstrap.min.css">
</head>
<body>
<?php include_once 'includes/main_nav.php' ?>
<div class="container">