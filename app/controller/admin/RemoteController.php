<?php
defined('_APP_PATH_') or exit('You shall not pass!');


require_service('RemoteCodeService');

class RemoteController extends AbstractController
{

    private $rcService;

    public function __construct()
    {
        parent::__construct();
        $this->rcService = new RemoteCodeService();
    }


    public function gen()
    {
        $this->rcService->set();
        $rc = $this->rcService->get_latest();
        $this->admin_view('remote-code', $rc, '远程交互');
    }

}