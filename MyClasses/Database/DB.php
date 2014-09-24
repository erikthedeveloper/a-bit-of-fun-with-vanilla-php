<?php

namespace MyClasses\Database;

/**
 * Class DB
 * @package MyClasses\Database
 * @author  Erik Aybar
 */
class DB implements MysqlConnectedInterface
{
    use PdoConnectionTrait;

    // TODO: Implement MysqliConnectionTrait
    // use MysqliConnectionTrait;
    // $mysqli_connection = new mysqli($database['host'], $database['user'], $database['password'], $database['database'], 3306);
}