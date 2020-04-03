<?php
defined('_ZERO_PATH_') OR exit('You shall not pass!');


require_once 'Common.php';
require_once 'Config.php';
require_once 'Router.php';
require_once 'Controller.php';


println(_SITE_URL_);

println(_ROOT_DIR__);

$router = new Router();
$router->dispatch();