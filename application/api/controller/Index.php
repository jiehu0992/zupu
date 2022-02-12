<?php
namespace app\api\controller;

use controller\BasicApiN;
use think\Db;
/**
 *
 * Class Index.php
 * @package app\admin\controller
 * @author 繁华如梦 <2398156504@qq.com>
 * @desc:通用API接口
 * @date 2022/2/8 12:57
 */
class Index extends BasicApiN {
    /**
     * 获取城市下拉选项
     */
    public function getCityOptions(){
        $area_id = input('post.area_id','','intval');
        $list = Db::name("system_region")->where(['pid'=>$area_id])->field('id,pid,name,type')->order('id asc,sort asc')->select();
        $data = '<option value="">请选择</option>'.PHP_EOL;
        foreach ($list as $key=>$value){
            $data .= "<option value='".$value['id']."'>".$value['name']."</option>".PHP_EOL;
        }
        return json($data);
    }


}