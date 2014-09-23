<?php
namespace MyClasses\Database;

/**
 * Interface ResourceInterface
 * @package MyClasses\Database
 * @author  Erik Aybar
 */
interface ResourceInterface
{

    /**
     * @return array
     * @author Erik Aybar
     */
    public static function getAll(array $wheres = [], array $order_bys = []);

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