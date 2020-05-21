<?php
defined('_APP_PATH_') or exit('You shall not pass!');

require_model('CategoryModel');

class CategoryService
{

    private $model;


    public function __construct()
    {
        $this->model = new CategoryModel();
    }

    public function list_data($parent){

    }


}