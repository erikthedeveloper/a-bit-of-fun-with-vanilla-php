<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] != "POST") {
    redirect_with_message('/users/index.php', "Bad method. Bad user!");
}

$upload_id = $_POST['id'];
$upload = \MyClasses\Models\Upload::getOne($upload_id);
$destroyed = \MyClasses\Models\Upload::destroy($upload_id);

redirect_user('/uploads/index.php', "You killed {$upload['original_filename']}!");

?>
