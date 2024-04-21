<?php

namespace MyApp;

function my_psr4_autoloader($class) { // in order to collect core files in one place we change the autoload
    $class_path = str_replace('\\', '/', $class);
    $class_path = str_replace("MyApp/", '', $class_path);
    $file =  __DIR__ . '/' . $class_path . '.php';
    // var_dump($file);
    // if the file exists, require it
    if (file_exists($file)) {
        require $file; // maybe require_once
    }
}
spl_autoload_register( __NAMESPACE__ . '\my_psr4_autoloader' );


class toolbar {
    static function dump($var) {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
    }
}

require_once("./Core/routes.php");

