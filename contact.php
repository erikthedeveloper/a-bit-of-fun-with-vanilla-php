<?php
require_once 'includes/header.php';
$grid_size = $_GET['grid_size'] ?: 10;
?>
<div class="jumbotron">
  <h1>A Great Contact Form</h1>

  <form action="submit.php" method="POST" class="form form-horizontal">
    <div class="form-group">
      <input type="text" name="foo" placeholder="Foo" class="form-control input-lg">
    </div>
    <div class="form-group">
      <textarea name="message" placeholder="Type your great message here..." class="form-control input-lg"></textarea>
    </div>
    <div class="form-group">
      <button class="btn btn-lg btn-block btn-primary">Go</button>
    </div>
  </form>

</div>
<?php require_once 'includes/footer.php' ?>