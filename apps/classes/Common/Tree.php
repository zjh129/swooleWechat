<?php

namespace App\Common;

/**
 * 数组转换为树结构数组类.
 */
class Tree
{
    public $pk; //主键字段名
    public $parentKey; //上级id字段名
    public $childrenKey; //用来存储子分类的数组key名
    public $nameKey = ''; //名称key
    private $OriginalList;

    public function __construct($pk='id', $parentKey='pid', $childrenKey='children')
    {
        if (!empty($pk) && !empty($parentKey) && !empty($childrenKey)) {
            $this->pk         =$pk;
            $this->parentKey  =$parentKey;
            $this->childrenKey=$childrenKey;
        } else {
            return false;
        }
    }

    //载入初始数组
    public function load($data)
    {
        if (is_array($data)) {
            $this->OriginalList=$data;
        }
    }

    /**
     * 生成嵌套格式的树形数组
     * array(..."children"=>array(..."children"=>array(...))).
     *
     * @param mixed $root
     */
    public function deepTree($root=0)
    {
        if (!$this->OriginalList) {
            return false;
        }
        $OriginalList=$this->OriginalList;
        $tree        =[]; //最终数组
        $refer       =[]; //存储主键与数组单元的引用关系
        //遍历
        foreach ($OriginalList as $k=>$v) {
            if (!isset($v[$this->pk]) || !isset($v[$this->parentKey]) || isset($v[$this->childrenKey])) {
                unset($OriginalList[$k]);
                continue;
            }
            $refer[$v[$this->pk]]=&$OriginalList[$k]; //为每个数组成员建立引用关系
        }
        //遍历2
        foreach ($OriginalList as $k=>$v) {
            if ($v[$this->parentKey] == $root) {//根分类直接添加引用到tree中
                $tree[]=&$OriginalList[$k];
            } else {
                if (isset($refer[$v[$this->parentKey]])) {
                    $parent                      =&$refer[$v[$this->parentKey]]; //获取父分类的引用
                    $parent[$this->childrenKey][]=&$OriginalList[$k]; //在父分类的children中再添加一个引用成员
                }
            }
        }

        return $tree;
    }

    /**
     * @param $arr
     *
     * @return array
     */
    public function make_tree($arr)
    {
        if (!function_exists('make_tree1')) {
            function make_tree1($arr, $parent_id=0)
            {
                $new_arr = [];
                foreach ($arr as $k=>$v) {
                    if ($v->parent_id == $parent_id) {
                        $new_arr[] = $v;
                        unset($arr[$k]);
                    }
                }
                foreach ($new_arr as &$a) {
                    $a->children = make_tree1($arr, $a->id);
                }

                return $new_arr;
            }
        }

        return make_tree1($arr);
    }

    /**
     * 设置显示的前缀字符.
     */
    public function makeTreeWithNamepre()
    {
        $this->deepTree();
        if (!function_exists('addNamepre')) {
            function addNamepre($prestr='')
            {
                foreach ($this->OriginalList as $k => $v) {
                    if ($prestr) {
                        if ($v == end($this->OriginalList)) {
                            $v[$this->nameKey] = $prestr . '└─ ' . $v[$this->nameKey];
                        } else {
                            $v[$this->nameKey] = $prestr . '├─ ' . $v[$this->nameKey];
                        }
                    }

                    if ($prestr == '') {
                        $prestrForChildren = '　 ';
                    } else {
                        if ($v == end($this->OriginalList)) {
                            $prestrForChildren = $prestr . '　　 ';
                        } else {
                            $prestrForChildren = $prestr . '│　 ';
                        }
                    }
                    if (isset($v[$this->childrenKey]) && $v[$this->childrenKey]) {
                        $v[$this->childrenKey] = addNamepre($v->children, $prestrForChildren);
                    }

                    $this->OriginalList[$k] = $v;
                }
            }
        }

        return addNamepre();
    }

    /**
     * @param $arr
     * @param int $depth，当$depth为0的时候表示不限制深度
     *
     * @return string
     */
    public function makeOptionTreeForSelect($depth=0)
    {
        $this->makeTreeWithNamepre();
        if (!function_exists('makeOptions')) {
            function makeOptions($arr, $depth, $recursionCount=0, $ancestorIds='')
            {
                $recursionCount++;
                $str = '';
                foreach ($arr as $v) {
                    $str .= "<option value='" . $v[$this->parentKey] . "' data-depth='{$recursionCount}' data-ancestorIds='" . ltrim($ancestorIds, ',') . "'>" . $v[$this->nameKey] . "</option>";
                    if ($v[$this->parentKey] == 0) {
                        $recursionCount = 1;
                    }
                    if ($depth == 0 || $recursionCount < $depth) {
                        $str .= makeOptions($v[$this->childrenKey], $depth, $recursionCount, $ancestorIds . ',' . $v[$this->parentKey]);
                    }
                }

                return $str;
            }
        }

        return makeOptions($this->OriginalList, $depth);
    }
}
