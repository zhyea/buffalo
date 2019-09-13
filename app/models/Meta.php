<?php


class Meta extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }


    public function query_category()
    {
        $query = $this->db->get('meta');
        return $query->result_array();
    }

}