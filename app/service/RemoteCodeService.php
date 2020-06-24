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
        $user = session_of('user');
        if (empty($user)) {
            return;
        }
        $rc = $this->rcModel->get_by_user($user['id']);
        $time = time();
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
        $rc['op_time'] = date('Y-m-d h:i:s', time());
        $this->rcModel->insert_or_update($rc);
    }


    public function get_latest()
    {
        $user = session_of('user');
        if (empty($user)) {
            return array('code' => '未知错误', 'expire_time' => '无法确定');
        }
        $rc = $this->rcModel->get_by_user($user['id']);
        $time = strtotime($rc['op_time']) + 60 * 60;
        $code = $rc['code'];
        return array('code' => $code, 'expire_time' => date('Y-m-d h:i:sa', $time));
    }


}