<?php

namespace MyClasses\Models;

use MyClasses\Database\DB;
use MyClasses\Database\ResourceInterface;

/**
 * Class BaseModel
 * @package MyClasses\Models
 * @author  Erik Aybar
 */
abstract class BaseModel extends DB implements ResourceInterface
{

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
        $sql         = "SELECT {$select_cols} FROM {$table}";
        $sql .= static::makeWhereClauseString($wheres);
        $sql .= static::makeOrderByString($order_bys);
        $collection = static::getConnection()->query($sql)->fetchAll();
        return $collection;
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
        $statement   = static::getConnection()->prepare("SELECT {$select_cols} FROM {$table} WHERE id = :id");
        $statement->execute(['id' => $id]);
        $individual = $statement->fetch();
        return $individual;
    }

    /**
     * @param $id
     * @return array
     * @author Erik Aybar
     */
    public static function getOneBy($field, $value, $condition = '=')
    {
        $table       = static::$table;
        $select_cols = static::getSelectColsString();
        $statement   = static::getConnection()->prepare("SELECT {$select_cols} FROM {$table} WHERE {$field} {$condition} :value LIMIT 1");
        $statement->execute(['value' => $value]);
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
        $success       = static::getConnection()->prepare("INSERT INTO {$table} {$insert_cols} VALUE {$insert_vals}")
            ->execute($create_data);
        $individual_id = (int)static::getConnection()->lastInsertId();
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
        $success       = static::getConnection()->prepare("UPDATE {$table} SET {$update_fields} WHERE id = :id")
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
        $statement = static::getConnection()->prepare("DELETE FROM {$table} WHERE id = :id");
        $destroyed = $statement->execute(['id' => $id]);
        return $destroyed;
    }

    /**
     * @return string
     * @author Erik Aybar
     */
    protected static function getSelectColsString()
    {
        return implode(", ", static::$select_cols);
    }

    /**
     * @param array $where
     * @return string
     * @author Erik Aybar
     */
    protected static function makeWhereClauseString(array $wheres)
    {
        $sql = "";
        if (!count($wheres)) {
            return $sql;
        }
        $sql .= " WHERE ";
        foreach ($wheres as $where) {
            $where_sql = "$where[0] {$where[1]} {$where[2]} AND ";
            $sql .= $where_sql;
        }
        $sql = rtrim($sql, " AND ");
        return $sql;
    }

    /**
     * @param array $order_bys
     * @return string
     * @author Erik Aybar
     */
    protected static function makeOrderByString(array $order_bys)
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
     * @param array $create_data
     * @return string
     * @author Erik Aybar
     */
    protected static function makeInsertColsString(array $create_data)
    {
        $create_data_keys = array_keys($create_data);
        return "(" . implode(", ", $create_data_keys) . ")";
    }

    /**
     * @param array $create_data
     * @return string
     * @author Erik Aybar
     */
    protected static function makeInsertValsString(array $create_data)
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
    protected static function makeUpdateFieldsString(array $update_data)
    {
        $str = "";
        foreach (array_keys($update_data) as $key) {
            $str .= "{$key} = :{$key}, ";
        }
        $str = rtrim($str, ", ");
        return $str;
    }

}