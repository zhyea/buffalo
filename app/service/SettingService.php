<?php
defined('_APP_PATH_') or exit('You shall not pass!');


require_model('SettingModel');

class SettingService
{


    private $model;


    public function __construct()
    {
        $this->model = new SettingModel();
    }


    public function findAll()
    {
        $result = array();
        $arr = $this->model->find_all();
        foreach ($arr as $ele) {
            if (!empty($ele['name'])) {
                $result[$ele['name']] = $ele['value'];
            }
        }
        return $result;
    }


}