<?php
defined('_APP_PATH_') or exit('You shall not pass!');


require_model('RemoteCodeModel');

class RemoteCodeService
{

    private $rcModel;


    public function __construct()
    {
        $this->rcModel = new RemoteCodeModel();
    }


    public function set()
    {
        $user = from_session('user');
        if (empty($user)) {
            return;
        }
        $rc = $this->rcModel->get_by_user($user['id']);
        $time = 0;
        if (empty($rc)) {
            $rc = array();
            $rc['user_id'] = $user['id'];
        } else {
            $t = $rc['op_time'];
            $time = strtotime($t);
        }

        $diff = (time() - $time) / 60;
        if ($diff < 40) {
            return;
        }
        $rc['code'] = strtoupper(uniqid());
        $rc['op_time'] = date('Y-m-d H:i:s', time());
        $this->rcModel->insert_or_update($rc);
    }


    public function get_latest()
    {
        $user = from_session('user');
        if (empty($user)) {
            return array('code' => '未知错误', 'expire_time' => '无法确定');
        }
        $rc = $this->rcModel->get_by_user($user['id']);
        $time = strtotime($rc['op_time']) + 60 * 50;
        $code = $rc['code'];
        return array('code' => $code, 'expire_time' => date('Y-m-d H:i:s', $time));
    }


    /**
     * 校验远程码是否有效
     * @param $code string 远程码
     * @return array|null 远程码对象
     */
    public function valid_code($code)
    {
        $rc = $this->rcModel->get_by_code($code);
        if (empty($rc)) {
            return null;
        }
        $time = strtotime($rc['op_time']);
        $diff = (time() - $time) / 60 - 60;
        if ($diff <= 0) {
            return null;
        }
        return $rc;
    }


}