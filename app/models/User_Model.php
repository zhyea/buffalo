<?php


class User_Model extends MY_Model
{

    public function all_users()
    {
        return $this->select_where('id, username, nickname');
    }

}