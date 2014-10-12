<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= isset($page['title']) ? $page['title'] : "A Page!" ?></title>
    <!-- Styles -->
    <link rel="stylesheet" media="screen" href="/assets/paper.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/slick/slick/slick.css"/>
    <link rel="stylesheet" href="/assets/main.css"/>
</head>
<body>
<?= get_partial('main_nav.php') ?>
<?= get_partial('flash_message.php') ?>
<div class="container">