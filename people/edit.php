<?php
$page['title'] = 'Pet Registry';
require_once '/includes/header.php';
/** @var PDO $pdo_connection */
$people = $pdo_connection->query("SELECT * FROM people ORDER BY last_name")->fetchAll();
?>
<div class="jumbotron">
    <h1>Update Yourself</h1>
    <?php include "partials/flash_message.php" ?>
    <form action="register_pet_submit.php" method="POST" class="form-horizontal">
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
</div>

<?php require_once 'includes/footer.php' ?>