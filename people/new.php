<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php' ?>
<?php
$page['title'] = 'New Person';
echo get_partial('header.php', ['page' => $page]);
?>

<h1>New Person...</h1>
<form action="/people/create.php" method="POST" class="form-horizontal">
    <div class="form-group">
        <div class="col-sm-3">
            <label>First Name</label>
            <input type="text" name="first_name" placeholder="Your First Name" class="form-control input-lg">
        </div>
        <div class="col-sm-3">
            <label>Last Name</label>
            <input type="text" name="last_name" placeholder="Your Last Name" class="form-control input-lg">
        </div>
        <div class="col-sm-2">
            <label>Age</label>
            <input type="number" name="age" placeholder="Your Age" min="18" max="99" value="21"
                   class="form-control input-lg">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-4">
            <button class="btn btn-lg btn-block btn-primary">Submit</button>
        </div>
    </div>
</form>


<?= get_partial('footer.php') ?>