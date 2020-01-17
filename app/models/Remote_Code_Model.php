<?php


class Remote_Code_Model extends MY_Model
{


    /**
     * 新增交互code
     *
     * @param int $user_id 用户ID
     * @return string 交互code
     */
    public function add($user_id)
    {
        $code = uniqid();
        $this->insert0(array('code' => $code, 'user_id' => $user_id));
        return $code;
    }


    /**
     * 检查交互code是否正确
     *
     * @param string $code 交互code
     * @return int 用户id
     * @throws Exception
     */
    public function check($code)
    {
        $date = new DateTime();
        $date->modify("-30 minutes");
        $t = date("Y-m-d H:i:s", $date->getTimestamp());
        $r = $this->get_where('user_id', array('code' => $code, 'time>' => $t));
        return is_null($r) ? 0 : $r['user_id'];
    }

}