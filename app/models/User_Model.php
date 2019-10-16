<?php


class User_Model extends MY_Model
{

    /**
     * 查询获取全部用户信息
     *
     * @return array 全部用户信息
     */
    public function all_users()
    {
        return $this->select_where('id, username, nickname, email');
    }


    /**
     * 根据ID查询获取用户信息
     *
     * @param int $id 用户记录ID
     * @return array 用户信息
     */
    public function get_by_id($id = 0)
    {
        return $this->get_by_id0('id, username, email, nickname', $id);
    }

}