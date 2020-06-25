<?php
defined('_APP_PATH_') or exit('You shall not pass!');


class RemoteCodeModel extends Z_Model
{

    public function get_by_user($user_id)
    {
        return $this->_get_by(array('user_id' => $user_id));
    }



    public function get_by_code($code)
    {
        return $this->_get_by(array('code' => $code));
    }
}