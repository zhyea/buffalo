<?php
defined('_APP_PATH_') or exit('You shall not pass!');


class RemoteController extends AbstractController
{

    public function gen()
    {
        $this->admin_view('remote-code', array('code' => '', 'expire_date' => '123'), '远程交互');
    }

}