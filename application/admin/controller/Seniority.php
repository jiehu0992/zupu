<?php
namespace app\admin\controller;

use controller\BasicAdmin;
use service\DataService;
use think\Db;
use think\Request;

/**
 *
 * Class Family.php
 * @package app\admin\controller
 * @author 繁华如梦 <2398156504@qq.com>
 * @desc:家族字辈管理
 * @date 2022/02/07 13:08
 */
class Seniority extends BasicAdmin{
    public $table = "system_family_seniority";
    public $fid;

    public function __construct(Request $request = null){
        parent::__construct($request);
        $this->fid = $this->request->param('fid','0','intval');
        if(empty($this->fid)) $this->error("请从家族列表【更多】进入",'/admin.html#/admin/family/index.html');
        $this->assign('fid',$this->fid);
    }

    /**
     * 字辈列表
     */
    public function index(){
        $this->title = "家族字辈管理";
        $db = Db::name($this->table)->where(['fid'=>$this->fid,'status'=>1,'is_deleted'=>0])
            ->order('sort asc,id asc');

        return parent::_list($db);
    }

    /**
     * 添加编辑字辈
     */
    public function edit(){
        return $this->_form($this->table,'form');
    }

    /**
     * 删除字辈
     */
    public function del(){
        if(DataService::update($this->table)){
            $this->success('操作成功！','');
        }
        $this->error('操作失败,请重试');
    }



}
