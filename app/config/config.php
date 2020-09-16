<?php
defined('_APP_PATH_') or exit('You shall not pass!');

$config['theme'] = 'sunny';
$config['suffix'] = '.html';
$config['max_file_zie'] = 36 * 1024 * 1024;
$config['time_zone'] = 'Asia/Shanghai';
$config['enable_cache'] = true;
$config['cache_exclude'] = ["/\/admin\/*/"];
$config['cache_include'] = ["/\/c\/*/"];