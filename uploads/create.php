<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

$file = $_FILES['file'];
$title = $_POST['title'];

$validator = new \MyClasses\Validation\Validator();
$file_validation_closure = function ($file)
{
    if (
        !in_array($file['type'], ['image/png', 'image/jpg', 'image/jpeg'])
        ||
        $file['size'] > 2000000
    ) {
        return false;
    };
    return true;
};
$rules = [
    'title' => ['not_empty'],
    'file'  => [$file_validation_closure]
];
$data = [
    'title' => $title,
    'file' => $file
];
$validator->validate($rules, $data);
$validator->redirectWithErrorsIfFailed('/uploads/new.php');

$fname_dest = UPLOAD_DIR . $file['name'] . mt_rand(1000, 10000);
move_uploaded_file($file['tmp_name'], $fname_dest);

//name
//type
//tmp_name
//error
//size

redirect_with_message('/uploads/new.php', 'File upload success!');

?>