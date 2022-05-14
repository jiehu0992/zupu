<?php
namespace app\admin\model;

use think\Model;
use think\Db;
/**
 *
 * Class BranchModel.php
 * @package app\admin\model
 * @author 繁华如梦 <2398156504@qq.com>
 * @desc:分支管理Model
 * @date 2022/2/8 15:40
 */
class BranchModel extends Model{
    protected $table = "system_family_member";

    /**
     * 无限下级用户查询
     */
    public function getUserChildren($user){
        static $data = [];  //首次调用初始化
        $result = Db::name($this->table)->where(['is_deleted'=>0,'pid'=>$user['id']])
            ->field('id,pid,fid,sid,name,gender,avastar,contact,nexus')->order('sort asc,id asc')->select();
        foreach ($result as $key=>$val){
            $data[] = $val;
            $this->getUserChildren($val);
        }
        return $data;
    }

    /**
     * 数据列表转换成树
     *
     * @param  array   $dataArr   数据列表
     * @param  integer $rootId    根节点ID
     * @param  string  $pkName    主键
     * @param  string  $pIdName   父节点名称
     * @param  string  $childName 子节点名称
     *
     * @return array  转换后的树
     */
    public function trans_list_to_tree($dataArr, $rootId = 0, $pkName = 'id', $pIdName = 'pid', $childName = 'children'){
        $tree = [];
        if (is_array($dataArr)) {
            $referList  = [];
            foreach ($dataArr as $key => & $sorData) {
                $referList[$sorData[$pkName]] =& $dataArr[$key];
            }
            foreach ($dataArr as $key => $data) {
                $pId = $data[$pIdName];
                if ($rootId == $pId) {
                    $tree[] =& $dataArr[$key];
                }else{
                    if (isset($referList[$pId])){
                        $pNode =& $referList[$pId];
                        $pNode[$childName][] =& $dataArr[$key];
                    }
                }
            }
        }
        return $tree;
    }

}