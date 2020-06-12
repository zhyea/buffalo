<?php
defined('_APP_PATH_') or exit('You shall not pass!');


class UserModel extends Z_Model
{


    /**
     * 检查并获取用户信息
     * @param $username string 用户名
     * @param $password string 密码
     * @return array 用户信息
     */
    public function get_and_check($username, $password)
    {
        return $this->_get_by(array('username' => $username, 'password' => $password));
    }


    /**
     * 根据用户名获取用户信息
     * @param $username string 用户名
     * @return array 用户信息
     */
    public function get_by_username($username)
    {
        return $this->_get_by(array('username' => $username));
    }


}