<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php' ?>
<?= get_partial('header.php') ?>
    <div class="jumbotron">
        <h1>A Great Contact Form</h1>

        <form action="submit.php" method="POST" class="form form-horizontal">
            <div class="form-group">
                <input type="text" name="name" placeholder="Your Name" class="form-control input-lg">
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Email" class="form-control input-lg">
            </div>
            <div class="form-group">
                <textarea name="message" rows="8" placeholder="Type your great message here..."
                          class="form-control input-lg"></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-lg btn-block btn-primary">Send</button>
            </div>
        </form>

    </div>
<?= get_partial('footer.php') ?>