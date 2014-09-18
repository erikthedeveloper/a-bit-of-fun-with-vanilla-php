<?php

namespace MyClasses\Models;

/**
 * Class Pet
 * @package MyClasses\Models
 * @author  Erik Aybar
 */
class Pet extends BaseModel
{

    protected static $table = 'pets';

    protected static $select_cols = [
        "id",
        "name"
    ];

}