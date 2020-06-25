<?php
defined('_APP_PATH_') or exit('You shall not pass!');

require_service('RemoteCodeService');

class PreHandleHook extends Z_RequestHook
{

    private $rcService;

    /**
     * PreHandleHook constructor.
     */
    public function __construct()
    {
        $this->rcService = new RemoteCodeService();
    }

    public function execute($path)
    {
        if (!str_start_with($path, '/admin')) {
            return;
        }
        $failed_count = from_session('failed', 0);

        $user = from_session('user', NULL);
        $code = from_header('Remote-Code');

        if (!empty($code)) {
            if ($failed_count > 20) {
                error_code(403, 'retry too many times');
            }
            $rc = $this->rcService->valid_code($code);
            if (empty($rc)) {
                $_SESSION['failed'] = $failed_count + 1;
                error_code(403, 'invalid remote code');
            }
            return;
        }
        if (empty($user)) {
            redirect_in_site('login');
            exit();
        }

        $last_log = from_session('last_log', 0);
        $diff = (time() - $last_log) / 60 / 60;
        if ($diff > 1) {
            unset($_SESSION['user']);
        }
        $_SESSION['last_log'] = time();
    }
}