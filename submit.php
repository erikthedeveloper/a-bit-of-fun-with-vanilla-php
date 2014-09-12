<?php
session_start();

$send_it = false;
//$send_it = true;

$to      = $_POST['email'];
$name    = $_POST['name'];
$subject = "Contact Submission: " . $name;
$message = $_POST['message'];

$sent = $send_it ? mail($to, $subject, $message) : false;
$data = compact('to', 'subject', 'message', 'sent');

$_SESSION['user_name'] = $name;

header('Content-Type: application/json');
echo json_encode($data);

?>