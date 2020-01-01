<?php

defined('BASEPATH') OR exit('No direct script access allowed');


if (!function_exists('list_to_tree')) {


    /**
     * 将列表转为树结构
     *
     * @param array $list 原始列表
     * @param string $pk 列表记录主键
     * @param string $pid 父ID字段
     * @param string $child 结果中子记录名称
     * @param int $root 根节点ID
     * @return array 树结构数组
     */
    function list_to_tree($list, $pk = 'id', $pid = 'parent', $child = '_child', $root = 0)
    {
        // 创建Tree
        $tree = array();
        if (is_array($list)) {
            // 创建基于主键的数组引用
            $refer = array();
            foreach ($list as $key => &$data) {
                if (is_null($data[$pid])) {
                    $data[$pid] = $root;
                }
                $refer[$data[$pk]] =& $list[$key];
            }
            foreach ($list as $key => $data) {
                // 判断是否存在parent
                $parentId = $data[$pid];

                if ($root == $parentId) {
                    $tree[$data[$pk]] = &$list[$key];
                } else {
                    if (isset($refer[$parentId])) {
                        $parent = &$refer[$parentId];
                        $parent[$child][$data[$pk]] = &$list[$key];

                        $parent[$child] = array_values($parent[$child]);
                    }
                }
            }
        }
        return $tree;
    }
}