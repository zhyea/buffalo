<?php


class Chapter_Model extends MY_Model
{

    /**
     * 写入章节内容
     *
     * @param int $work_id 作品ID
     * @param int $volume_id 分卷ID
     * @param string $title 章节标题
     * @param string $content 章节内容
     * @param int $chapter_id 章节ID
     * @return int 章节ID
     */
    public function update($work_id, $volume_id, $title, $content, $chapter_id = 0)
    {
        return $this->insert_or_update(
            array('work_id' => $work_id, 'volume_id' => $volume_id, 'name' => $title, 'content' => $content), $chapter_id
        );
    }

    /**
     * 查找作品章节信息
     *
     * @param int $work_id 作品ID
     * @return array 作品章节信息
     */
    public function find_by_work_id($work_id)
    {
        return $this->select_where1('id,  name, volume_id', array('work_id' => $work_id));
    }


    /**
     * 查询章节信息
     *
     * @param int $id 章节ID
     * @return array 章节信息
     */
    public function get_by_id($id)
    {
        return $this->get_by_id0($id, 'id, name, content, volume_id');
    }


    /**获取上一章
     *
     * @param int $work_id 作品ID
     * @param int $id 章节ID
     * @return array|null 上一章
     */
    public function get_last($work_id, $id)
    {
        $r = $this->select_where("id, name",
            "work_id=" . $work_id . " and id<" . $id,
            1, NULL, "id", "desc");
        if (sizeof($r) > 0) {
            return $r[0];
        } else {
            return NULL;
        }
    }


    /**获取下一章
     *
     * @param int $work_id 作品ID
     * @param int $id 章节ID
     * @return array|null 下一章
     */
    public function get_next($work_id, $id)
    {
        $r = $this->select_where("id, name",
            "work_id=" . $work_id . " and id>" . $id,
            1, NULL, "id", "asc");
        if (sizeof($r) > 0) {
            return $r[0];
        } else {
            return NULL;
        }
    }


    /**
     * 根据ID集合批量删除记录
     *
     * @param array $ids ID集合
     * @return int 删除操作影响的记录数量
     */
    public function delete_by_work_id($ids = array())
    {
        if (0 === sizeof($ids)) {
            return 0;
        }
        return $this->db->where_in('work_id', $ids)->delete($this->table);
    }



    /**
     * 名称获取记录
     *
     * @param string $name 名称
     * @return array 记录
     */
    public function get_by_name($name)
    {
        return $this->get_where("id, name", array('name' => $name));
    }

}