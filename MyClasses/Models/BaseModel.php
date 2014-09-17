<?php

namespace MyClasses\Models;

use MyClasses\Database\PdoConnectionTrait;

/**
 * Class BaseModel
 * @package MyClasses\Models
 * @author  Erik Aybar
 */
class BaseModel {

    protected static $table;

    use PdoConnectionTrait;

    /**
     * @return array
     * @author Erik Aybar
     */
    public static function getAll()
    {
        $people = static::getPdoConnection()->query("SELECT * FROM " . static::$table . " ORDER BY last_name")->fetchAll();
        return $people;
    }

    /**
     * @param $id
     * @return array
     * @author Erik Aybar
     */
    public static function getOne($id)
    {
        $statement = static::getPdoConnection()->prepare('SELECT * FROM " . static::$table . " WHERE id = :id');
        $statement->execute(['id' => $id]);
        $person = $statement->fetch();
        return $person;
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
        $success   = static::getPdoConnection()->prepare('INSERT INTO " . static::$table . " (first_name, last_name, age) VALUE (:first_name, :last_name, :age)')
            ->execute(['first_name' => $first_name, 'last_name' => $last_name, 'age' => $age]);
        $people_id = (int)static::getPdoConnection()->lastInsertId();
        return $people_id;
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
        $success = static::getPdoConnection()->prepare('UPDATE " . static::$table . " SET first_name = :first_name, last_name = :last_name, age = :age WHERE id = :id')
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
        $statement = static::getPdoConnection()->prepare('DELETE FROM " . static::$table . " WHERE id = :id');
        $destroyed = $statement->execute(['id' => $id]);
        return $destroyed;
    }
}