<?php

namespace MyClasses\Models;

/**
 * Class People
 * @package MyClasses\Models
 * @author  Erik Aybar
 */
class People extends BaseModel
{

    /**
     * @return array
     * @author Erik Aybar
     */
    public static function getAll()
    {
        $people = static::getPdoConnection()->query("SELECT * FROM people ORDER BY last_name")->fetchAll();
        return $people;
    }

    /**
     * @param $id
     * @return array
     * @author Erik Aybar
     */
    public static function getOne($id)
    {
        $statement = static::getPdoConnection()->prepare('SELECT * FROM people WHERE id = :id');
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
        $success   = static::getPdoConnection()->prepare('INSERT INTO people (first_name, last_name, age) VALUE (?, ?, ?)')
            ->execute([$first_name, $last_name, $age]);
        $people_id = (int) static::getPdoConnection()->lastInsertId();
        return $people_id;
    }

    /**
     * @param $id
     * @return bool
     * @author Erik Aybar
     */
    public static function destroy($id){
        $statement = static::getPdoConnection()->prepare('DELETE FROM people WHERE id = :id');
        $destroyed = $statement->execute(['id' => $id]);
        return $destroyed;
    }
} 