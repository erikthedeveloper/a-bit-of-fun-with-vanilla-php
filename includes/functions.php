<?php

/**
 * @param      $destination
 * @param null $flash_message
 * @author Erik Aybar
 * @deprecated
 */
function redirect_user($destination, $flash_message = "Default fake message!")
{
    redirect_with_message($destination, $flash_message);
}

/**
 * @param       $destination
 * @param array $flash
 * @author Erik Aybar
 */
function redirect_with_flash_array($destination, array $flash)
{
    $_SESSION['flash'] = $flash;
    header("Location: " . $destination);
    exit;
}

/**
 * @param $destination
 * @param $message
 * @author Erik Aybar
 */
function redirect_with_message($destination, $message)
{
    $flash = ['message' => $message];
    redirect_with_flash_array($destination, $flash);
}

/**
 * @param       $path
 * @param array $data
 * @return string
 * @author Erik Aybar
 */
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

function error_field_alert($field_name)
{
    return (isset($_SESSION['flash']) && isset($_SESSION['flash']['errors']) && isset($_SESSION['flash']['errors'][$field_name]))
        ? "<strong><span class=\"text-danger\">{$_SESSION['flash']['errors'][$field_name]}</span></strong>"
        : '';
}

function flash_input_value($field_name)
{
    return (isset($_SESSION['flash']) && isset($_SESSION['flash']['input']) && isset($_SESSION['flash']['input'][$field_name]))
        ? $_SESSION['flash']['input'][$field_name]
        : null;
}
 