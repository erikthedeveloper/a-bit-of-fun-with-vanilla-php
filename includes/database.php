<?php
$database = [
    'host'     => "localhost",
    'user'     => "homestead",
    'password' => "secret",
    'database' => "cs4000_fun"
];

\MyClasses\Database\DB::connect($database['host'], $database['user'], $database['password'], $database['database']);