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
        // Delete File from Filesystem
        return parent::destroy($id);
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
     * @param       $id
     * @param array $file
     * @return string
     * @author Erik Aybar
     */
    public static function getHashedFiledNameFromFile($id, array $file)
    {
        $exploded = explode(".", $file['name']);
        $ext = end($exploded);
        $hash_me = $file['name'] . $file['size'] . $file['type'];
        $real_path = md5($hash_me) . "." . $ext;
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