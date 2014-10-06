<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

$rules = [
    'save_as' => "/\w+/"
];

$validator = new \MyClasses\Validation\Validator();
$validator->validate($rules, $_POST);
$validator->redirectWithErrorsIfFailed('/uploads/new.php');

$file = $_FILES['file'];

$fname_dest = UPLOAD_DIR . $file['name'];

move_uploaded_file($file['tmp_name'], $fname_dest);

redirect_with_message('/uploads/new.php', 'File upload success!');

?>