<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php' ?>
<?php
if (!isset($_GET['id'])) {
    redirect_user('/people/index.php', 'No person found for ID ... or you didn\'t supply one!');
}
$person_id = $_GET['id'];

$person = \MyClasses\Models\Person::getOne($person_id);
$page['title'] = 'Show Person';
?>
<?= get_partial('header.php', ['page' => $page]) ?>

<h1><?= $person['first_name'] . " " . $person['last_name'] ?></h1>
<div class="row">
    <div class="col-sm-8">
        <p>
            At age <?= $person['age'] ?>, <?= $person['first_name'] ?> is a Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, accusamus ad assumenda atque aut consectetur dignissimos ducimus eaque error id, ipsum iure maiores maxime placeat quia, reiciendis repellat repudiandae totam?
        </p>
    </div>
    <div class="col-sm-4">
        <img class="img-responsive img-circle" src="http://lorempixel.com/400/400/people" alt=""/>
    </div>
</div>

<form action="/people/destroy.php" onsubmit="return confirm('Are you sure?!?!!! .... ??');">
    <a class="btn btn-sm btn-info" href="/people/edit.php?id=<?= $person['id'] ?>">Edit <?= $person['first_name'] ?></a>
    <input type="hidden" name="id" value="<?= $person['id'] ?>"/>
    <button class="btn btn-sm btn-danger">Destroy <?= $person['first_name'] ?></button>
</form>


<?= get_partial('footer.php') ?>