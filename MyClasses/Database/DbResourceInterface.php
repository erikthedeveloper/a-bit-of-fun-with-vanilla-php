<?php
namespace MyClasses\Database;

/**
 * Interface DbResourceInterface
 * @package MyClasses\Database
 * @author  Erik Aybar
 */
interface DbResourceInterface
{

    /**
     * @return array
     * @author Erik Aybar
     */
    public static function getAll();

    /**
     * @param $id
     * @return array
     * @author Erik Aybar
     */
    public static function getOne($id);

    /**
     * @param array $create_data
     * @return bool
     * @author Erik Aybar
     */
    public static function create(array $create_data);

    /**
     * @param       $id
     * @param array $update_data
     * @return bool
     * @author Erik Aybar
     */
    public static function update($id, array $update_data);

    /**
     * @param $id
     * @return bool
     * @author Erik Aybar
     */
    public static function destroy($id);
}