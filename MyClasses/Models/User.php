<?php

namespace MyClasses\Models;

/**
 * Class User
 * @package MyClasses\Models
 * @author  Erik Aybar
 */
class User extends BaseModel
{

    protected static $table = 'users';

    protected static $select_cols = [
        "id",
        "first_name",
        "last_name",
        "email",
        "encrypted_password"
    ];

}