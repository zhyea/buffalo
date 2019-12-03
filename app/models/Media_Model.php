<?php


class Media_Model extends MY_Model
{


    /**
     * 添加文件记录
     *
     * @param string $name 文件名称
     * @param string $path 文件保存路径
     * @param int $id 记录ID
     * @return int 记录ID
     */
    public function update_img($name = NULL, $path = NULL, $id = 0)
    {
        if (empty($path)) {
            return 0;
        }
        if (empty($name)) {
            $name = trim(strrchr($path, '/'), '/');
        }

        return $this->insert_or_update(array('name' => $name, 'path' => $path, 'type' => 1), $id);
    }


    /**
     * 获取媒体文件路径
     * @param int $id 文件记录ID
     * @return string 文件路径
     */
    public function get_media_path($id)
    {
        $media = $this->get_by_id0($id);
        if (is_null($media)) {
            return '';
        }
        return $media['path'];
    }

}