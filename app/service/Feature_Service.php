<?php


class Feature_Service extends MY_Service
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('feature_model');
    }



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
}