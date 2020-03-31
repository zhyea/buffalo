<?php
defined('_ZERO_PATH_') OR exit('You shall not pass!');


require_once 'Common.php';
require_once 'Config.php';


$uri = $_SERVER['REQUEST_URI'];

$method = $_SERVER['REQUEST_METHOD'];

$query_str = $_SERVER['QUERY_STRING'];

$path = substr($uri, strlen($_SERVER['SCRIPT_NAME']));


println($uri);

println($method);

println($query_str);

println($path);

println(_SITE_URL_);

println(_ROOT_DIR__);
println(_APP_PATH_);
println($view_folder);
println(_VIEW_PATH_);


foreach (_R_ as $key => $value) {
    if (str_start_with($path, $key)) {
        $sub = rtrim($path, $key);
        println($sub . '-' . $value);
        $controller = ucwords(strtolower($value)) . 'Controller';
        $path_controller = _APP_PATH_ . 'controller' . DIRECTORY_SEPARATOR . $controller . '.php';
        if (file_exists($path_controller)) {
            if (class_exists($controller, FALSE) === FALSE) {
                require_once $path_controller;
                println('------');
            }
        }

        $obj = new $controller();

        $obj ->index();
    }
}