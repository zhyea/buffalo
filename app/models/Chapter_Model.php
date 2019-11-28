<?php


class Chapter_Model extends MY_Model
{

    /**
     * 写入章节内容
     *
     * @param int $work_id 作品ID
     * @param string $title 章节标题
     * @param string $content 章节内容
     * @return int 章节ID
     */
    public function insert($work_id, $title, $content)
    {
        return $this->insert0(
            array('work_id' => $work_id, 'name' => $title, 'content' => $content)
        );
    }


}