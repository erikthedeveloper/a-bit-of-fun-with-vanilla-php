<?php

namespace MyClasses\Models;

/**
 * Class File
 * @package MyClasses\Models
 * @author  Erik Aybar
 */
/**
 * Class Upload
 * @package MyClasses\Models
 * @author  Erik Aybar
 */
class Upload extends BaseModel
{

    /**
     * @var string
     */
    protected static $table = 'uploads';

    /**
     * @var array
     */
    protected static $select_cols = [
        "id",
        "original_filename",
        "file_type",
        "file_size",
        "title",
        "uploaded_at",
        "stored_filename"
    ];

    public static function destroy($id)
    {
        $upload = static::getOne($id);
        $real_path = static::getRealPathFromStoredName($upload['stored_filename']);;
        $destroyed = (file_exists($real_path) && parent::destroy($id));
        return $destroyed;
    }


    /**
     * @param $id
     * @return string
     * @author Erik Aybar
     */
    public static function locationFromId($id)
    {
        return UPLOAD_DIR . 'upload_';
    }

    /**
     * @param       $upload_id
     * @param array $file
     * @return string
     * @author Erik Aybar
     */
    public static function getHashedFiledNameFromFile($upload_id, array $file)
    {
        $exploded = explode(".", $file['name']);
        $ext = end($exploded);
        $real_path = md5($upload_id) . "." . $ext;
        return $real_path;
    }

    /**
     * @param $stored_name
     * @return string
     * @author Erik Aybar
     */
    public static function getRealPathFromStoredName($stored_name)
    {
        return UPLOAD_DIR . $stored_name;
    }

    /**
     * @param $stored_name
     * @return string
     * @author Erik Aybar
     */
    public static function getPublicPathFromStoredName($stored_name)
    {
        return "/uploads/files/{$stored_name}";
    }

}