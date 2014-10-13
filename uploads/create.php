<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

$file  = $_FILES['file'];
$title = $_POST['title'];

$validator               = new \MyClasses\Validation\Validator();
$file_validation_message = 'File validation failed.';
$file_validation_closure = function ($file) use (&$file_validation_message) {
    if (!in_array($file['type'], ['image/png', 'image/jpg', 'image/jpeg'])) $file_validation_message .= ' Invalid file type.';
    if ($file['size'] > 2000000) $file_validation_message .= " File too large.";

    if (
        !in_array($file['type'], ['image/png', 'image/jpg', 'image/jpeg'])
        ||
        $file['size'] > 2000000
    ) {
        return false;
    };
    return true;
};
$rules                   = [
    'title' => ['not_empty'],
    'file'  => [$file_validation_closure]
];
$data                    = [
    'title' => $title,
    'file'  => $file
];
$validator->validate($rules, $data);
if ($validator->hasErrors()) {
    redirect_with_message('/uploads/index.php', $file_validation_message);
}
//$validator->redirectWithErrorsIfFailed('/uploads/index.php');


$upload_create_data = [
    "original_filename" => $file['name'],
    "file_type"         => $file['type'],
    "file_size"         => $file['size'],
    "title"             => $title
];


$upload_id = \MyClasses\Models\Upload::create($upload_create_data);
$stored_filename = \MyClasses\Models\Upload::getHashedFiledNameFromFile($upload_id, $file);
\MyClasses\Models\Upload::update($upload_id, ["stored_filename"   => $stored_filename]);
$real_path_dest = \MyClasses\Models\Upload::getRealPathFromStoredName($stored_filename);
//mkdir($new_dir);
move_uploaded_file($file['tmp_name'], $real_path_dest);
//chmod($file_path, 0644);

redirect_with_message('/uploads/index.php', "{$file['name']} was uploaded!");

?>