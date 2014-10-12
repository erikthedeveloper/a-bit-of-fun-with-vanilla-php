<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

$uploaded_files = \MyClasses\Models\Upload::getAll([], ['id DESC']);

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

<div class="list-group">
    <?php foreach (array_chunk($uploaded_files, 3) as $uploaded_files_chunk): ?>
        <div class="list-group-item">
            <div class="row">
                <?php foreach ($uploaded_files_chunk as $file):
                    $public_path = \MyClasses\Models\Upload::getPublicPathFromStoredName($file['stored_filename']);
                    ?>
                    <div class="col-sm-4 text-center" style="overflow: hidden;">
                        <h5><?= $file['title'] ?></h5>
                        <a href="<?= $public_path ?>" target="_blank">
                        <img class="img-responsive" src="<?= $public_path ?>" alt=""/>
                            <small><?= $file['original_filename'] ?></small>
                        </a>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    <?php endforeach ?>
</div>
<?= get_partial('footer.php') ?>
 