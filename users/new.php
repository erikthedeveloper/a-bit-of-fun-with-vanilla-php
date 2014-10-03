<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php' ?>
<?php
$page['title'] = 'New User';
echo get_partial('header.php', ['page' => $page]);
?>

<h1>New User...</h1>
<form action="/users/create.php" method="POST" class="form-horizontal">
    <div class="form-group">
        <div class="col-sm-6">
            <label>First Name</label>
            <input type="text" name="first_name" placeholder="Your First Name" class="form-control input-lg" value="<?= flash_input_value('first_name') ?>">
            <?= error_field_alert('first_name') ?>
        </div>
        <div class="col-sm-6">
            <label>Last Name</label>
            <input type="text" name="last_name" placeholder="Your Last Name" class="form-control input-lg" value="<?= flash_input_value('last_name') ?>">
            <?= error_field_alert('last_name') ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-12">
            <label>Email</label>
            <input type="email" name="email" placeholder="Your Email" class="form-control input-lg" value="<?= flash_input_value('email') ?>">
            <?= error_field_alert('email') ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-6">
            <label>Password</label>
            <input type="password" name="password" placeholder="Your Password" class="form-control input-lg">
        </div>
        <div class="col-sm-6">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" placeholder="Confirm Password" class="form-control input-lg">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-4">
            <button class="btn btn-lg btn-block btn-primary">Submit</button>
        </div>
    </div>
</form>


<?= get_partial('footer.php') ?>