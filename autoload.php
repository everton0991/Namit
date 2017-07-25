<?php
spl_autoload_register(function ($class_name) {
    include __DIR__.'/'.str_replace('\\','/',str_replace('App','app',$class_name)) . '.php';

    // Check to see whether the include declared the class
    if (!class_exists($class_name, false)) {
        trigger_error("Unable to load class: $class_name", E_USER_WARNING);
    }
});

require_once __DIR__.'/vendor/autoload.php';