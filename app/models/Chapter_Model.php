<?php


class Chapter_Model extends MY_Model
{

    /**
     * 写入章节内容
     *
     * @param int $work_id 作品ID
     * @param string $title 章节标题
     * @param string $content 章节内容
     * @param int $chapter_id 章节ID
     * @return int 章节ID
     */
    public function update($work_id, $title, $content, $chapter_id = 0)
    {
        return $this->insert_or_update(
            array('work_id' => $work_id, 'name' => $title, 'content' => $content), $chapter_id
        );
    }

    /**
     * 查找作品章节信息
     *
     * @param int $work_id 作品ID
     * @return array 作品章节信息
     */
    public function chapters($work_id)
    {
        return $this->select_where1('id, parent, name', array('work_id' => $work_id));
    }


    /**
     * 查询章节信息
     *
     * @param int $id 章节ID
     * @return array 章节信息
     */
    public function get_by_id($id)
    {
        return $this->get_by_id0($id, 'id, name, content');
    }


}