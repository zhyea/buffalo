<?php


class Feature_Service extends MY_Service
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('feature_model');
        $this->load->model('feature_record_model');
    }


    /**
     * 执行更新 / 删除操作
     * @param array $data 数据详情
     * @param int $id 记录ID
     * @return mixed 执行结果
     */
    public function update($data, $id)
    {
        $r = $this->upload_img('cover');
        $path = '';
        if ($r[0]) {
            $f = $this->feature_model->get_by_id($id);
            if (!is_null($f)) {
                $old = $f['cover'];
                $file_path = VIEWPATH . 'uploads/' . $old;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            $path = $r[1];
        }
        if (!empty($path)) {
            $data['cover'] = $path;
        }
        return $this->feature_model->insert_or_update($data, $id);
    }


    /**
     * 查询首页推荐内容
     *
     * @return array 推荐内容
     */
    public function find_all_recommend()
    {
        return $this->feature_record_model->find_works_by_alias('recommend', 6);
    }
}