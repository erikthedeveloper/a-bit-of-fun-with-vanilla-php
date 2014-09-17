<?php

function redirect_user($destination, $flash_message = null)
{
    if ($flash_message) $_SESSION['flash']['message'] = $flash_message;
    header("Location: " . $destination);
    exit;
}

function get_partial($path, $data = [])
{
    extract($data);
    ob_start();
    $path = $_SERVER['DOCUMENT_ROOT'] . '/partials/' . $path;
    include $path;
    $rendered = ob_get_contents();
    ob_clean();
    return $rendered;
}
 