<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

$file  = $_FILES['file'];
$title = $_POST['title'];

$validator = new \MyClasses\Validation\Validator();
$rules     = [
    'title' => ['not_empty'],
    'file'  => ['image_upload_file']
];
$data                    = [
    'title' => $title,
    'file'  => $file
];
$validator->validate($rules, $data);
if ($validator->getError('upload_image')) {
    redirect_with_message('/uploads/index.php', $validator->getError('upload_image'));
}
$validator->redirectIfFailed('/uploads/index.php');

$upload_id = \MyClasses\Models\Upload::createAndSave($file['tmp_name'], $file['name'], $file['type'], $file['size'], $title);

redirect_with_message('/uploads/index.php', "{$file['name']} was uploaded!");

?>