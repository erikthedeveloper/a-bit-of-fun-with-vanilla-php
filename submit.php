<?php
header('Content-Type: application/json');

$send_it = false;
//$send_it = true;

$to      = $_POST['email'];
$subject = "Contact Submission: " . $_POST['subject'];
$message = $_POST['message'];

$sent = $send_it ? mail($to, $subject, $message) : false;
$data = compact('to', 'subject', 'message', 'sent');

echo json_encode($data);
?>