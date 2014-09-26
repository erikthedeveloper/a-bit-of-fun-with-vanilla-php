<?php

/**
 * PSR-4 autoloader provided by PSR-4 documentation on GitHub
 */
spl_autoload_register(
    function ($class) {
        // project-specific namespace prefix
        $prefix = 'MyClasses\\';

        // base directory for the namespace prefix
        $base_dir = __DIR__ . '/../MyClasses/';

        // does the class use the namespace prefix?
        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) !== 0) {
            // no, move to the next registered autoloader
            return;
        }

        // get the relative class name
        $relative_class = substr($class, $len);

        // replace the namespace prefix with the base directory, replace namespace
        // separators with directory separators in the relative class name, append
        // with .php
        $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

        // if the file exists, require it
        if (file_exists($file)) {
            require $file;
        }
    }
);