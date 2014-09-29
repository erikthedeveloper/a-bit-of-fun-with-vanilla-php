<?php

namespace MyClasses\Auth;

use Exception;
use MyClasses\Models\User;

/**
 * Class AuthMaster
 * @package MyClasses\Auth
 * @author  Erik Aybar
 */
class AuthMaster
{

    /**
     * @return array|bool
     * @throws Exception
     * @author Erik Aybar
     */
    public static function getCurrentUser()
    {
        if (!static::checkIfLoggedIn()) return false;
        $user_id = $_SESSION['user_id'];
        $user = User::getOne($user_id);
        if (!$user) throw new Exception("User not found using session user_id {$user_id}. Bad!");
        return $user;
    }

    /**
     * @return bool
     * @author Erik Aybar
     */
    public static function checkIfLoggedIn()
    {
        $is_logged_in = isset($_SESSION['user_id']);
        return $is_logged_in;
    }

    /**
     * @param int $user
     * @author Erik Aybar
     */
    public static function logUserInUsingId($user_id)
    {
        $_SESSION['user_id'] = $user_id;
    }

    /**
     * @author Erik Aybar
     */
    public static function logOut()
    {
        unset($_SESSION['user_id']);
    }

    /**
     * @param string $destination
     * @author Erik Aybar
     */
    public static function redirectIfNotLoggedIn($destination = '/users/login.php')
    {
        if (!static::checkIfLoggedIn()) {
            $message = "You ain't logged in!";
            redirect_user($destination, $message);
        }
    }

    /**
     * @param string $destination
     * @author Erik Aybar
     */
    public static function redirectIfLoggedIn($destination = '/')
    {
        if (static::checkIfLoggedIn()) {
            $message = "You are already logged in!";
            redirect_user($destination, $message);
        }
    }

}