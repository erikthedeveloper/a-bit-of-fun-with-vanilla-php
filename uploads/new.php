<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

$uploaded_files = array_slice(scandir(UPLOAD_DIR), 2);

$page['title'] = 'Upload a File';
echo get_partial('header.php', ['page' => $page]);
?>

<h1>Upload that File!</h1>

<form method="POST" enctype="multipart/form-data" action="/uploads/create.php">
    <div class="form-group">
        <div class="col-sm-5">
            File: <input type="file" name="file" id="file">
        </div>
        <div class="col-sm-5">
            <label class="control-label" for="title">Title:</label>
            <input type="text" class="form-control input-md" name="title" id="title"/>
        </div>
        <div class="col-sm-2">
            <button class="btn btn-lg btn-primary">Upload</button>
        </div>
    </div>
</form>

<div class="clearfix"></div>

<ul class="list-group">
    <?php foreach ($uploaded_files as $file): ?>
    <li class="list-group-item">
        <a href="/uploads/files/<?= $file ?>">
            <?= $file ?>
        </a>
    </li>
    <?php endforeach ?>
</ul>
<?= get_partial('footer.php') ?>
 