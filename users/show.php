<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php' ?>
<?php
if (!isset($_GET['id'])) {
    redirect_user('/users/index.php', 'No user found for ID ... or you didn\'t supply one!');
}
$user_id = $_GET['id'];

$user = \MyClasses\Models\User::getOne($user_id);
$page['title'] = 'Show User';
?>
<?= get_partial('header.php', ['page' => $page]) ?>

<h1><?= $user['first_name'] . " " . $user['last_name'] ?></h1>
<div class="row">
    <div class="col-sm-8">
        <p>
            <?= $user['first_name'] ?> is a Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, accusamus ad assumenda atque aut consectetur dignissimos ducimus eaque error id, ipsum iure maiores maxime placeat quia, reiciendis repellat repudiandae totam?
        </p>
    </div>
    <div class="col-sm-4">
        <img class="img-responsive img-circle" src="http://lorempixel.com/400/400/users" alt=""/>
    </div>
</div>

<form action="/users/destroy.php" method="POST" onsubmit="return confirm('Are you sure?!?!!! .... ??');">
    <a class="btn btn-sm btn-info" href="/users/edit.php?id=<?= $user['id'] ?>">Edit <?= $user['first_name'] ?></a>
    <input type="hidden" name="id" value="<?= $user['id'] ?>"/>
    <button class="btn btn-sm btn-danger">Destroy <?= $user['first_name'] ?></button>
</form>


<?= get_partial('footer.php') ?>