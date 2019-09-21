<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Hooks extends CI_Hooks
{


    public function __construct()
    {
        parent::__construct();


        $this->load =& load_class('Loader', 'core');
        $this->load->initialize();

        log_message('info', 'Hook Class Initialized');
    }


}