<?php


class MY_Controller extends CI_Controller
{


    public function viewOf($view, $vars = array(), $return = FALSE)
    {
        $this->load->view($view, $vars, $return);
    }


    public function modelOf($model, $name = '', $db_conn = FALSE)
    {
        $this->load->model($model, $name, $db_conn);
    }


    public function helperOf($helpers = array())
    {
        $this->load->helper($helpers);
    }

}