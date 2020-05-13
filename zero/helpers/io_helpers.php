<?php

defined('_ZERO_PATH_') or exit('You shall not pass!');


if (!function_exists('upload_path')) {

    /**
     * return the upload path
     *
     * @param $file string file path
     * @return string full path of file
     */
    function upload_path($file)
    {
        return _UPLOAD_PATH_ . (str_start_with($file, '/') ? '' : DIRECTORY_SEPARATOR) . $file;
    }
}


if (!function_exists('del_upload_file')) {

    /**
     * delete the uploaded file
     *
     * @param $file string full path of file
     */
    function del_upload_file($file)
    {
        if (!empty($file)) {
            $p = upload_path($file);
            del_file($p);
        }
    }
}