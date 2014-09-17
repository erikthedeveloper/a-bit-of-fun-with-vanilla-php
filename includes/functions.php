<?php

function redirect_user($destination, $flash_message = null)
{
    if ($flash_message) $_SESSION['flash']['message'] = $flash_message;
    header("Location: " . $destination);
    exit;
}
 