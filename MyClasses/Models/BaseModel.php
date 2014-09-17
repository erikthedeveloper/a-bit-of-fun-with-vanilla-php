<?php

namespace MyClasses\Models;

use MyClasses\Database\PdoConnectionTrait;

/**
 * Class BaseModel
 * @package MyClasses\Models
 * @author  Erik Aybar
 */
class BaseModel
{

    /**
     * Uses PDO for MySQL
     */
    use PdoConnectionTrait;

    /**
     * @var string
     */
    protected static $table;

    /**
     * @var array
     */
    protected static $select_cols = ["*"];


    /**
     * @return array
     * @author Erik Aybar
     */
    public static function getAll()
    {
        $table       = static::$table;
        $select_cols = static::getSelectColsString();
        $collection  = static::getPdoConnection()->query("SELECT {$select_cols} FROM {$table} ORDER BY last_name")->fetchAll();
        return $collection;
    }

    /**
     * @return string
     * @author Erik Aybar
     */
    private static function getSelectColsString()
    {
        return implode(", ", static::$select_cols);
    }

    /**
     * @param $id
     * @return array
     * @author Erik Aybar
     */
    public static function getOne($id)
    {
        $table       = static::$table;
        $select_cols = static::getSelectColsString();
        $statement   = static::getPdoConnection()->prepare("SELECT {$select_cols} FROM {$table} WHERE id = :id");
        $statement->execute(['id' => $id]);
        $individual = $statement->fetch();
        return $individual;
    }

    /**
     * @param $first_name
     * @param $last_name
     * @param $age
     * @return int
     * @author Erik Aybar
     */
    public static function create($first_name, $last_name, $age)
    {
        $table         = static::$table;
        $success       = static::getPdoConnection()->prepare('INSERT INTO {$table} (first_name, last_name, age) VALUE (:first_name, :last_name, :age)')
            ->execute(['first_name' => $first_name, 'last_name' => $last_name, 'age' => $age]);
        $individual_id = (int)static::getPdoConnection()->lastInsertId();
        return $individual_id;
    }

    /**
     * @param $id
     * @param $first_name
     * @param $last_name
     * @param $age
     * @return bool
     * @author Erik Aybar
     */
    public static function update($id, $first_name, $last_name, $age)
    {
        $table   = static::$table;
        $success = static::getPdoConnection()->prepare('UPDATE {$table} SET first_name = :first_name, last_name = :last_name, age = :age WHERE id = :id')
            ->execute(['first_name' => $first_name, 'last_name' => $last_name, 'age' => $age, 'id' => $id]);
        return $success;
    }

    /**
     * @param $id
     * @return bool
     * @author Erik Aybar
     */
    public static function destroy($id)
    {
        $table     = static::$table;
        $statement = static::getPdoConnection()->prepare('DELETE FROM {$table} WHERE id = :id');
        $destroyed = $statement->execute(['id' => $id]);
        return $destroyed;
    }
}