<?php
defined('_APP_PATH_') or exit('You shall not pass!');

require_model('UserModel');

class UserService
{

    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }




    public function checkLogin($username, $password)
    {

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