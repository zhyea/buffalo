<?php
defined('_APP_PATH_') or exit('You shall not pass!');


require_model('SettingModel');
require_model('ScriptModel');

class SettingService
{


    private $settingModel;
    private $scriptModel;


    public function __construct()
    {
        $this->settingModel = new SettingModel();
        $this->scriptModel = new ScriptModel();
    }


    public function findAll()
    {
        $result = array();
        $arr = $this->settingModel->find_all();
        foreach ($arr as $ele) {
            if (!empty($ele['name'])) {
                $result[$ele['name']] = $ele['value'];
            }
        }

        $arr = $this->scriptModel->find_all();
        foreach ($arr as $ele) {
            if (!empty($ele['code'])) {
                $result[$ele['code']] = $ele['script'];
            }
        }

        return $result;
    }


}