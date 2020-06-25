<?php
defined('_APP_PATH_') or exit('You shall not pass!');


require_model('UserModel');

class UserService
{

    private $userModel;

    private $salt = '#_淦x7';

    public function __construct()
    {
        $this->userModel = new UserModel();
    }


    /**
     * 检查登录信息
     * @param $username string 用户名
     * @param $password string 密码
     * @return array 用户信息
     */
    public function check_login($username, $password)
    {
        $password = md5($password . $this->salt);
        return $this->userModel->check_and_get($username, $password);
    }


    /**
     * 获取客户端IP
     * @return string 客户端IP
     */
    private function clientIp()
    {
        $ip = getenv('HTTP_X_REAL_IP');
        if (empty($ip)) {
            $ip = getenv('HTTP_X_FORWARD_FOR');
        }
        if (empty($ip)) {
            $ip = getenv('HTTP_CLIENT_IP');
        }
        if (empty($ip)) {
            $ip = getenv('REMOTE_ADDR');
        }
        return $ip;
    }



}