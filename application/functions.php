<?php

// +----------------------------------------------------------------------
// | 公共函数库
// +----------------------------------------------------------------------

use think\Db;

/**
 * 获取家族名称
 */
function getFamilyName($fid = 0,$field="name"){
    $data = Db::name("system_family")->where(['id'=>$fid])->value($field);
    return empty($data)?"暂无数据":$data;
}

/**
 * 字辈下拉选框
 * @param int $sid 选中字辈
 * @param $fid int 家族ID
 */
function buildSeniorityOptions($sid=0,$fid){
    $data = '<option value="">请选择</option>'.PHP_EOL;
    if(!empty($fid)){
        $list = Db::name("system_family_seniority")->where(['is_deleted'=>0,'status'=>1,'fid'=>$fid])
            ->order('sort asc,id asc')->field('id,seniority')->select();
        foreach($list as $key=>$value){
            if($value['id'] == $sid){
                $data .= "<option value='".$value['id']."' selected=''>".$value['seniority']."</option>".PHP_EOL;
            }else{
                $data .= "<option value='".$value['id']."'>".$value['seniority']."</option>".PHP_EOL;
            }
        }
    }
    return $data;
}

/**
 * 获取字辈名称
 */
function getSeniorityName($sid = 0){
    $data = Db::name("system_family_seniority")->where(['id'=>$sid])->value('seniority');
    return empty($data)?"暂无数据":$data;
}

/**
 * 获取地区名称
 */
function getRegionName($aid=0){
    $data = Db::name("system_region")->where(['id'=>$aid])->value('name');
    return $data;
}