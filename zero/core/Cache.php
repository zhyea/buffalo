<?php


class Z_Cache
{

    /**
     * 文件路径
     */
    private $cache_file;

    /**
     * 缓存文件生命周期
     */
    private $lifetime;

    /**
     * 缓存目录
     */
    private $cache_dir;

    /**
     * 构造器
     * @param $path string 文件路径
     */
    function __construct($path)
    {
        if (empty($path)) {
            $path = "/index";
        }
        if (str_end_with($path, "/")) {
            $path = $path . "index";
        }

        $this->cache_file = _CACHE_PATH_ . $path;

        $last_slash_idx = strrpos($this->cache_file, "/");
        $dir = substr($this->cache_file, 0, $last_slash_idx);
        if (!is_dir($dir)) {
            @mkdir($dir, 0777, true);
        }

        $this->lifetime = 3 * 24 * 60 * 60;
    }


    /**
     * 加载缓存
     * exit() 载入缓存后终止原页面程序的执行,缓存无效则运行原页面程序生成缓存
     * ob_start() 开启浏览器缓存用于在页面结尾处取得页面内容
     */
    public function load()
    {
        if ($this->is_valid()) {
            require_once($this->cache_file);
            //echo file_get_contents($this->cache_file);
            echo "<!--缓存-->";
            exit ();
        } else {
            ob_start();
        }
    }


    /**
     * 写缓存
     */
    public function write()
    {

        $content = ob_get_contents();
        //写入到缓存内容到指定的文件夹
        $fp = fopen($this->cache_file, 'w');
        fwrite($fp, $content);
        fclose($fp);
        //从PHP内存中释放出来缓存（取出数据）
        ob_flush();
        //把释放的数据发送到浏览器显示
        flush();
        //清空缓冲区的内容并关闭这个缓冲区
        ob_end_clean();

    }


    /**
     * 检查缓存是否有效
     */
    private function is_valid()
    {
        if (!file_exists($this->cache_file))
            return false;
        if (!(@$mtime = filemtime($this->cache_file)))
            return false;
        if (time() - $mtime > $this->lifetime) {
            $this->clean();
            return false;
        }

        return true;
    }

    /**
     * 清除缓存
     */
    public function clean()
    {
        unlink($this->cache_file);
    }


    /**
     * 检查是否应用缓存
     * @param $path string 请求路径
     * @return bool 是否应用缓存
     */
    public static function use_cache($path)
    {
        if (!array_key_exists('cache_enable', _CFG_)) {
            return false;
        }

        if (!_CFG_['cache_enable']) {
            return false;
        }

        $cache_exclude = [];
        if (array_key_exists('cache_exclude', _CFG_)) {
            $cache_exclude = _CFG_['cache_exclude'];
        }

        foreach ($cache_exclude as $pattern) {
            if (preg_match($pattern, $path)) {
                return false;
            }
        }


        $cache_include = [];

        if (array_key_exists('cache_include', _CFG_)) {
            $cache_include = _CFG_['cache_include'];
        }

        foreach ($cache_include as $pattern) {
            if (preg_match($pattern, $path)) {
                return true;
            }
        }

        if(!empty($cache_include)){
            return false;
        }


        if(!empty($cache_exclude)){
            return true;
        }

        return false;
    }

}