<?php

namespace MyClasses\Database;

use PDO;

trait PdoConnectionTrait
{

    /**
     * @var PDO
     */
    static protected $pdo_connection;

    /**
     * @param     $host
     * @param     $user
     * @param     $password
     * @param     $database
     * @param int $port
     * @author Erik Aybar
     */
    public static function connect($host, $user, $password, $database, $port = 3306)
    {
        $dsn               = "mysql:host={$host};dbname={$database}";
        $pdo_connection    = new PDO($dsn, $user, $password);
        static::setConnection($pdo_connection);
    }

    /**
     * @return PDO
     * @author Erik Aybar
     */
    public static function getConnection()
    {
        return static::$pdo_connection;
    }


    /**
     * @param PDO $pdo_connection
     * @author Erik Aybar
     */
    public static function setConnection($pdo_connection)
    {
        static::$pdo_connection = $pdo_connection;
    }

}