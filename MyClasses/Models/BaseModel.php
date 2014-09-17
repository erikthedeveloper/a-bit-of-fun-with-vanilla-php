<?php

namespace MyClasses\Models;

use PDO;

/**
 * Class BaseModel
 * @package MyClasses\Models
 * @author  Erik Aybar
 */
class BaseModel {

    /**
     * @var PDO
     */
    static private $pdo_connection;


    /**
     * @return PDO
     * @author Erik Aybar
     */
    public static function getPdoConnection()
    {
        return self::$pdo_connection;
    }


    /**
     * @param PDO $pdo_connection
     * @author Erik Aybar
     */
    public static function setPdoConnection(PDO $pdo_connection)
    {
        self::$pdo_connection = $pdo_connection;
    }
}