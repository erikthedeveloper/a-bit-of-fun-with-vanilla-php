<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php' ?>
<?php
if (!isset($_GET['id'])) {
    redirect_user('/users/index.php', 'No user found for ID ... or you didn\'t supply one!');
}
$user_id = $_GET['id'];
$user = \MyClasses\Models\User::getOne($user_id);

$page['title'] = 'Edit User';
echo get_partial('header.php', ['page' => $page]);
?>

<h1>Edit <?= $user['first_name'] . " " . $user['last_name'] ?></h1>
<form action="/users/update.php" method="POST" class="form-horizontal">
    <div class="form-group">
        <div class="col-sm-3">
            <label>First Name</label>
            <input type="text" name="first_name" value="<?= $user['first_name'] ?>" placeholder="Your First Name" class="form-control input-lg">
        </div>
        <div class="col-sm-3">
            <label>Last Name</label>
            <input type="text" name="last_name" value="<?= $user['last_name'] ?>" placeholder="Your Last Name" class="form-control input-lg">
        </div>
        <div class="col-sm-2">
            <label>Age</label>
            <input type="number" name="age" value="<?= $user['age'] ?>" placeholder="Your Age" min="18" max="99" value="21"
                   class="form-control input-lg">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-4">
            <input type="hidden" name="id" value="<?= $user['id'] ?>"/>
            <button class="btn btn-lg btn-block btn-primary">Submit</button>
        </div>
    </div>
</form>


<?= get_partial('footer.php') ?>