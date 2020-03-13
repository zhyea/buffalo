<?php


/** 定义根目录 */
define('_ROOT_DIR__', dirname(__FILE__));


/** 配置zero框架路径 */
$zero_path = 'zero';

if (($_temp = realpath($zero_path)) !== FALSE) {
    $zero_path = $_temp . DIRECTORY_SEPARATOR;
} else {
    $zero_path = strtr(
            rtrim($zero_path, '/\\'),
            '/\\',
            DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR
        ) . DIRECTORY_SEPARATOR;
}

define('_ZERO_PATH_', $zero_path);


/** 加载zero框架 */
require_once _ZERO_PATH_ . 'core/Z.php';
