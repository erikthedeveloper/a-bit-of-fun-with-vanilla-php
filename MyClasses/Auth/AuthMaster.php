<?php

namespace MyClasses\Auth;

/**
 * Class AuthMaster
 * @package MyClasses\Auth
 * @author  Erik Aybar
 */
class AuthMaster
{

    /**
     * @return bool
     * @author Erik Aybar
     */
    public static function checkIfLoggedIn()
    {
        $is_logged_in = isset($_SESSION['user']);
        return $is_logged_in;
    }

    /**
     * @param array $user
     * @author Erik Aybar
     */
    public static function logUserInUsingUserArray(array $user)
    {
        $safe_data = [];
        $approved_fields = ['first_name', 'last_name'];
        foreach ($approved_fields as $key) {
            $safe_data[$key] = $user[$key];
        }
        $_SESSION['user'] = $safe_data;
    }

    /**
     * @author Erik Aybar
     */
    public static function logOut()
    {
        unset($_SESSION['user']);
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