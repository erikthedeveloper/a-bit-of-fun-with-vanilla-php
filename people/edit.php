<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php' ?>
<?php
$page['title'] = 'Edit Person';
echo get_partial('header.php');
if (!isset($_GET['id'])) {
    redirect_user('/people/index.php', 'No person found for ID ... or you didn\'t supply one!');
}
$person_id = $_GET['id'];

$person = \MyClasses\Models\Person::getOne($person_id);
?>

<h1>Edit <?= $person['first_name'] . " " . $person['last_name'] ?></h1>
<form action="/people/update.php" method="POST" class="form-horizontal">
    <div class="form-group">
        <div class="col-sm-3">
            <label>First Name</label>
            <input type="text" name="first_name" value="<?= $person['first_name'] ?>" placeholder="Your First Name" class="form-control input-lg">
        </div>
        <div class="col-sm-3">
            <label>Last Name</label>
            <input type="text" name="last_name" value="<?= $person['last_name'] ?>" placeholder="Your Last Name" class="form-control input-lg">
        </div>
        <div class="col-sm-2">
            <label>Age</label>
            <input type="number" name="age" value="<?= $person['age'] ?>" placeholder="Your Age" min="18" max="99" value="21"
                   class="form-control input-lg">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-4">
            <input type="hidden" name="id" value="<?= $person['id'] ?>"/>
            <button class="btn btn-lg btn-block btn-primary">Submit</button>
        </div>
    </div>
</form>


<?= get_partial('footer.php') ?>