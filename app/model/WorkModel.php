<?php
defined('_APP_PATH_') or exit('You shall not pass!');


class WorkModel extends Z_Model
{

    /**
     * 修改分类
     * @param $old_cat int 原分类ID
     * @param $new_cat int 新分类ID
     * @return bool 是否修改成功
     */
    public function change_cat($old_cat, $new_cat)
    {
        $sql = 'update work set category_id=? where category_id=?';
        return $this->_execute($sql, array($new_cat, $old_cat));
    }

}