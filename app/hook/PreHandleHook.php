<?php
defined('_APP_PATH_') or exit('You shall not pass!');


class PreHandleHook extends Z_RequestHook
{

    public function execute($path)
    {
        if (str_start_with($path, '/admin')) {
            $user = session_of('user', NULL);
            if (empty($user)) {
                redirect_in_site('login');
                exit();
            }

            $last_log = session_of('last_log', 0);
            $diff = (time() - $last_log) / 60 / 60;
            if ($diff > 1) {
                unset($_SESSION['user']);
            }
            $_SESSION['last_log'] = time();
        }
    }
}