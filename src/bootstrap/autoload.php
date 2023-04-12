<?php
/**
 * Simple autoload
 * @param $class_name - String name for the class that is trying to be loaded.
 */
function simple_autoload($class_name) {
    $file = dirname(__DIR__) . '/' . str_replace('\\', '/', $class_name) . '.php';
    if (file_exists($file)) {
        require_once $file;
    } else {
        throw new Exception(sprintf('Class { %s } Not Found!', $class_name));
    }
}

spl_autoload_register('simple_autoload');