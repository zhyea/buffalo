<?php

defined('BASEPATH') OR exit('No direct script access allowed');


if (!function_exists('list_to_tree')) {


    /**
     * 将数组转为树结构
     *
     * @param array $arr 原始列表
     * @param string $pk 列表记录主键
     * @param string $pid 父ID字段
     * @param string $child 结果中子记录名称
     * @param int $root 根节点ID
     * @return array 树结构数组
     */
    function list_to_tree($arr, $pk = 'id', $pid = 'parent', $child = '_child', $root = 0)
    {
        // 创建Tree
        $tree = array();
        if (!is_array($arr)) {
            return $tree;
        }


        foreach ($arr as &$v) {
            if (is_null($v[$pid])) {
                $v[$pid] = $root;
            }
            $tree[$v[$pk]] =& $v;
        }

        foreach ($tree as &$v) {
            if (!$v[$pid]) {
                continue;
            }
            $tree[$v[$pid]][$child][] = &$v;
        }

        foreach ($tree as $k => &$v) {
            if (!$v[$pid]) {
                continue;
            }
            unset($tree[$k]);
        }

        return $tree;
    }
}