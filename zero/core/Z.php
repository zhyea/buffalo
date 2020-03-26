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