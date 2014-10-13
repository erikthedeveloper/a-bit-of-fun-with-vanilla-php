<?php

namespace MyClasses\Models;

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

    /**
     * @param $id
     * @return bool
     * @author Erik Aybar
     */
    public static function destroy($id)
    {
        $upload    = static::getOne($id);
        $real_path = static::getRealPathFromStoredName($upload['stored_filename']);;
        $destroyed = (file_exists($real_path) && unlink($real_path) && parent::destroy($id));
        return $destroyed;
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
     * @param $id
     * @return string
     * @author Erik Aybar
     */
    public static function locationFromId($id)
    {
        return UPLOAD_DIR . 'upload_';
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

    /**
     * @param        $tmp_name
     * @param        $filename
     * @param        $type
     * @param        $size
     * @param string $title
     * @return int
     * @author Erik Aybar
     */
    public static function createAndSave($tmp_name, $filename, $type, $size, $title = 'untitled')
    {
        $upload_id       = static::create([
            "original_filename" => $filename,
            "file_type"         => $type,
            "file_size"         => $size,
            "title"             => $title
        ]);
        $stored_filename = static::getStorableFileName($upload_id, $filename);
        static::update($upload_id, ["stored_filename" => $stored_filename]);
        $real_path_dest = static::getRealPathFromStoredName($stored_filename);
        move_uploaded_file($tmp_name, $real_path_dest);
        return $upload_id;
    }

    /**
     * @param       $upload_id
     * @param       $file
     * @return string
     * @author Erik Aybar
     */
    public static function getStorableFileName($upload_id, $filename)
    {
        $exploded  = explode(".", $filename);
        $ext       = end($exploded);
        $real_path = md5($upload_id) . "." . $ext;
        return $real_path;
    }
}