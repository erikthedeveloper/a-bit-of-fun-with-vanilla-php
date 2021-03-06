<?php

namespace MyClasses\Models;

/**
 * Class Person
 * @package MyClasses\Models
 * @author  Erik Aybar
 */
class Person extends BaseModel
{

    protected static $table = 'people';

    protected static $select_cols = [
        "id",
        "first_name",
        "last_name",
        "age"
    ];

}