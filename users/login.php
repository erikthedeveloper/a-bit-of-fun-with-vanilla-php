<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php' ?>
<?php
$page['title'] = 'New User';
echo get_partial('header.php', ['page' => $page]);
?>

<div class="jumbotron">
    <h1>Log In</h1>
    <form action="/users/submit_login.php" method="POST" class="form-horizontal">
        <div class="form-group">
            <div class="col-sm-5">
                <label class="sr-only">Email</label>
                <input type="email" name="email" placeholder="Your Email" class="form-control input-lg">
            </div>
            <div class="col-sm-5">
                <label class="sr-only">Password</label>
                <input type="password" name="password" placeholder="Your Password" class="form-control input-lg">
            </div>
            <div class="col-sm-2">
                <button class="btn btn-lg btn-block btn-primary">Log In</button>
            </div>
        </div>
    </form>
</div>

<?= get_partial('footer.php') ?>