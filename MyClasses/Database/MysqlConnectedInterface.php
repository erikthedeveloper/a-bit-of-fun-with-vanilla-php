<?php

namespace MyClasses\Database;

/**
 * Interface MysqlConnectedInterface
 * @package MyClasses\Database
 * @author  Erik Aybar
 */
interface MysqlConnectedInterface {

    public static function connect($host, $user, $password, $database, $port = 3306);

    public static function getConnection();

    public static function setConnection($connection);

} 