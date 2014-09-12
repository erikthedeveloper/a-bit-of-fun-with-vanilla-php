<?php
require_once 'includes/header.php';
?>
  <div class="jumbotron">
    <h1>The Form <small>to the database</small></h1>

    <form action="submit.php" method="POST" class="form form-horizontal">
      <div class="form-group">
        <input type="text" name="first_name" placeholder="First Name" class="form-control input-lg">
      </div>
      <div class="form-group">
        <input type="text" name="last_name" placeholder="Last Name" class="form-control input-lg">
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
<?php require_once 'includes/footer.php' ?>