<?php

error_reporting(-1);

use vendor\core\Router;

function debug($arr)
{
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}

define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__) . "\\app");
define('CONFIG', dirname(__DIR__) . "\\config");
define('LAYOUT', 'default');

spl_autoload_register(function ($class){
    $class = ROOT . "\\" . $class . ".php";
    if(is_file($class))
        require_once $class;
});

$url = trim($_SERVER['REQUEST_URI']);

Router::add("^$", ["controller"=>"home", "action"=>"index"]);
Router::add("(?P<controller>[a-z-_]+)/(?P<action>[a-z-_]+)/?(?P<id>[0-9]+)?");
Router::add("(?P<controller>[a-z-_]+)/?(?P<id>[0-9]+)?");
Router::run($url);
