<?php
defined('_APP_PATH_') or exit('You shall not pass!');


class AuthorModel extends Z_Model
{


    public function suggest($keywords)
    {
        $keywords = '%' . $keywords . '%';
        $sql = 'select id, name, country from author where name like ? or country like ? order by id desc limit 9';
        return $this->_find($sql, array($keywords, $keywords));
    }

}