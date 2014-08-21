<?php

/**
 * Require Slim and all other stuff from composer
 */
require 'vendor/autoload.php';

/**
 * Initialize Slim
 */
$app = new Slim\Slim(array(
    'debug' => true,
    'templates.path' => 'view'
));

/**
 * Autoload classes
 *
 * Require all classes from model and lib directory.
 * In case of other namespace it's try to retrieve class
 * in directory equaling to name of second segment of class.
 * If it's loading class without namespace, script try to get it from top direcory.
 */
spl_autoload_register(function ($class) {
    $parts=explode("\\", $class);
    if(count($parts)>1){
        switch ($parts[1]) {
            case 'Lib':
                require_once 'lib/'.strtolower($parts[2]).'/'.end($parts) . '.php';
                break;
            case 'Model':
                require_once 'model/'.end($parts) . '.php';
                break;
            default:
                require_once strtolower($parts[1]).'/'.end($parts) . '.php';
                break;
        }
    } else {
        require_once end($parts) . '.php';
    }
});

/**
 * Require all controllers from controllers directory
 */
foreach (glob("controller/*.php") as $filename)
{
    require $filename;
}

/**
 * Go!
 */
$app->run();