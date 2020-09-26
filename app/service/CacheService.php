<?php
defined('_APP_PATH_') or exit('You shall not pass!');


class CacheService
{


    public function clean()
    {
        $dir = scandir(_CACHE_PATH_);
        foreach ($dir as $child) {
            if ($child != "." && $child != "..") {
                $child = _CACHE_PATH_ . DIRECTORY_SEPARATOR . $child;
                del_dir($child);
            }
        }
    }

}