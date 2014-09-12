<?php
require_once 'includes/header.php';
//$people = [];
//$pets = [];
?>
    <div class="jumbotron">
        <h1>Register Your Pet</h1>
        <?php include "partials/flash_message.php" ?>
        <form action="the_form_submit.php" method="POST" class="form form-horizontal">
            <div class="form-group">
                <input type="text" name="first_name" placeholder="Your First Name" class="form-control input-lg">
            </div>
            <div class="form-group">
                <input type="text" name="last_name" placeholder="Your Last Name" class="form-control input-lg">
            </div>
            <div class="form-group">
                <input type="number" name="age" placeholder="Your Age" class="form-control input-lg">
            </div>
            <div class="form-group">
                <input type="text" name="pet_name" placeholder="Your Pet's Name" class="form-control input-lg">
            </div>
            <div class="form-group">
                <button class="btn btn-lg btn-block btn-primary">Send</button>
            </div>
        </form>

    </div>
<?php require_once 'includes/footer.php' ?>