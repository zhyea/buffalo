<?php
defined('_APP_PATH_') or exit('You shall not pass!');


class RemoteCodeModel extends Z_Model
{

    public function get_by_user($user_id)
    {
        $sql = 'select * from remote_code where user_id=? order by id desc limit 1';
        return $this->_get($sql, array($user_id));
    }

}