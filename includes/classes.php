<?php

$class_dir  = APP_ROOT . '/MyClasses';
$iter_dir   = new RecursiveDirectoryIterator($class_dir);
$iter_iter  = new RecursiveIteratorIterator($iter_dir);
$iter_regex = new RegexIterator($iter_iter, '/^.+\.php$/i', RecursiveRegexIterator::GET_MATCH);
foreach ($iter_regex as $class_file) {
    include_once $class_file[0];
}

\MyClasses\Models\BaseModel::setPdoConnection($pdo_connection);