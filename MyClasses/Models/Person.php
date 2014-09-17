<?php

namespace MyClasses\Models;

use MyClasses\Database\DbResourceInterface;

/**
 * Class Person
 * @package MyClasses\Models
 * @author  Erik Aybar
 */
class Person extends BaseModel implements DbResourceInterface
{

    protected static $table = 'people';

    protected static $select_cols = [
        "id",
        "first_name",
        "last_name",
        "age"
    ];

}