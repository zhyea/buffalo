<?php
defined('_APP_PATH_') or exit('You shall not pass!');


require_model('AuthorModel');

class AuthorService
{

    private $authorModel;

    public function __construct()
    {
        $this->authorModel = new AuthorModel();
    }


    public function all()
    {
        $authors = $this->authorModel->find_all();
        $result = array();
        foreach ($authors as $a) {
            $pinyin = pinyin($a['name']);
            if (empty($pinyin)) {
                $pinyin = '0';
            }
            $pinyin = ucfirst($pinyin);
            $f = substr($pinyin, 0, 1);
            if (!array_key_exists($f, $result)) {
                $result[$f] = array();
            }
            $arr = &$result[$f];
            array_push($arr, $a);
        }
        return $result;
    }

}