<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

$uploaded_files = \MyClasses\Models\Upload::getAll([], ['id DESC']);

$page['title'] = 'Upload a File';
echo get_partial('header.php', ['page' => $page]);
?>

<h1>A Great Image Gallery</h1>


<form class="form form-horizontal" method="POST" enctype="multipart/form-data" action="/uploads/create.php">
    <div class="form-group">
        <div class="col-sm-2">
            <p class="lead">
                Go Ahead.
                <br/>
                Add an image!
            </p>
        </div>
        <div class="col-sm-3">
            <label class="control-label" for="file">File (.png, .jpg, .jpeg):</label>
            <input type="file" name="file" id="file">
        </div>
        <div class="col-sm-3">
            <label class="control-label" for="title">Title:</label>
            <input type="text" class="form-control input-md" name="title" id="title" value="Image Without a Title #<?= mt_rand(123, 456) ?>"/>
        </div>
        <div class="col-sm-2">
            <strong>Upload Your Image!</strong><br/>
            <button class="btn btn-lg btn-primary">Upload</button>
        </div>
    </div>
</form>

</div>

<div style="margin-bottom: 20px;"></div>
<!--.container-->

<div class="jumbotron">
    <h3>Slick
        <small>the last carousel you'll ever need</small>
    </h3>

    <div class="slick-gallery-nav">
        <?php foreach ($uploaded_files as $file):
            $public_path = \MyClasses\Models\Upload::getPublicPathFromStoredName($file['stored_filename']);
            ?>
            <div class="slick-gallery-item text-center">
                <img class="img-responsive" src="<?= $public_path ?>" alt=""/>
            </div>
        <?php endforeach ?>
    </div>

    <div class="slick-gallery-main">
        <?php foreach ($uploaded_files as $file):
            $public_path = \MyClasses\Models\Upload::getPublicPathFromStoredName($file['stored_filename']);
            ?>
            <div class="slick-gallery-item text-center">
                <h5><?= $file['title'] ?></h5>
                <a href="<?= $public_path ?>" target="_blank">
                    <small><?= $file['original_filename'] ?></small>
                    <hr/>
                    <img class="img-responsive" src="<?= $public_path ?>" alt=""/>
                </a>
            </div>
        <?php endforeach ?>
    </div>

</div>

<div class="container">
    <h3>Bootstrap
        <small>Simple Grid Layout</small>
    </h3>

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
 