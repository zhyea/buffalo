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

            $first_log = session_of('first_log', 0);
            $diff = (time() - $first_log) / 60 / 60;
            if ($diff > 2) {
                unset($_SESSION['user']);
            }

        }
    }
}