<?php

namespace MyClasses\Models;

use MyClasses\Database\DbResourceInterface;
use MyClasses\Database\PdoConnectionTrait;

/**
 * Class BaseModel
 * @package MyClasses\Models
 * @author  Erik Aybar
 */
class BaseModel implements DbResourceInterface
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
    public static function getAll(array $wheres = [], array $order_bys = [])
    {
        $table       = static::$table;
        $select_cols = static::getSelectColsString();
        $sql = "SELECT {$select_cols} FROM {$table}";
        $sql .= static::makeWhereClauseString($wheres);
        $sql .= static::makeOrderByString($order_bys);
        //var_dump($sql); exit;
        $collection  = static::getPdoConnection()->query($sql)->fetchAll();
        return $collection;
    }

    /**
     * @param array $where
     * @return string
     * @author Erik Aybar
     */
    public static function makeWhereClauseString(array $wheres)
    {
        $sql = "";
        if (!count($wheres)) {
            return $sql;
        }
        $sql .= " WHERE ";
        foreach ($wheres as $where) {
            $where_sql = "$where[0] {$where[1]} {$where[2]}";
            $sql .= $where_sql;
        }
        return $sql;
    }

    /**
     * @param array $order_bys
     * @return string
     * @author Erik Aybar
     */
    public static function makeOrderByString(array $order_bys)
    {
        $sql = "";
        if (!count($order_bys)) {
            return $sql;
        }
        $sql .= " ORDER BY ";
        foreach ($order_bys as $order_by) {
            $order_by = $order_by . " ,";
            $sql .= $order_by;
        }
        $sql = rtrim($sql, " ,");
        return $sql;
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
     * @param array $create_data
     * @return int
     * @author   Erik Aybar
     */
    public static function create(array $create_data)
    {
        $table         = static::$table;
        $insert_cols   = static::makeInsertColsString($create_data);
        $insert_vals   = static::makeInsertValsString($create_data);
        $success       = static::getPdoConnection()->prepare("INSERT INTO {$table} {$insert_cols} VALUE {$insert_vals}")
            ->execute($create_data);
        $individual_id = (int)static::getPdoConnection()->lastInsertId();
        return $individual_id;
    }

    /**
     * @param       $id
     * @param array $update_data
     * @return bool
     * @author   Erik Aybar
     */
    public static function update($id, array $update_data)
    {
        $table         = static::$table;
        $update_fields = static::makeUpdateFieldsString($update_data);
        $success       = static::getPdoConnection()->prepare("UPDATE {$table} SET {$update_fields} WHERE id = :id")
            ->execute(array_merge($update_data, ['id' => $id]));
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
        $statement = static::getPdoConnection()->prepare("DELETE FROM {$table} WHERE id = :id");
        $destroyed = $statement->execute(['id' => $id]);
        return $destroyed;
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
     * @param array $create_data
     * @return string
     * @author Erik Aybar
     */
    private static function makeInsertColsString(array $create_data)
    {
        $create_data_keys = array_keys($create_data);
        return "(" . implode(", ", $create_data_keys) . ")";
    }

    /**
     * @param array $create_data
     * @return string
     * @author Erik Aybar
     */
    private static function makeInsertValsString(array $create_data)
    {
        $create_data_keys = array_keys($create_data);
        for ($i = 0; $i < count($create_data_keys); $i++) {
            $create_data_keys[$i] = ":" . $create_data_keys[$i];
        }
        return "(" . implode(", ", $create_data_keys) . ")";
    }

    /**
     * @param array $update_data
     * @return string
     * @author Erik Aybar
     */
    private static function makeUpdateFieldsString(array $update_data)
    {
        $str = "";
        foreach (array_keys($update_data) as $key) {
            $str .= "{$key} = :{$key}, ";
        }
        $str = rtrim($str, ", ");
        return $str;
    }
}