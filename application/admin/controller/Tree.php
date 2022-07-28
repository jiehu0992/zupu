<?php
namespace app\admin\controller;

use controller\BasicAdmin;
use service\DataService;
use service\ToolsService;
use think\Db;
use think\Loader;
use think\Request;
/**
 *
 * 家族树形表格
 * @package app\admin\controller
 * @author 繁华如梦 <2398156504@qq.com>
 * @desc:
 * @date 2022/5/10 12:48
 */
class Tree extends BasicAdmin{
    public $table = "system_family_member";
    public $fid;

    public function __construct(Request $request = null){
        parent::__construct($request);
        $this->fid = $this->request->param('fid','0','intval');
        if(empty($this->fid)) $this->error("请从家族列表【更多】进入",'/admin.html#/admin/family/index.html');
        $this->assign('fid',$this->fid);
    }
    /**
     * 列表
     * @return array|string
     */
    public function index(){
        $this->title = "家族树";
        $db = Db::name($this->table)->alias('m')->where(['m.fid'=>$this->fid,'m.is_deleted'=>0]);
        foreach (['name','contact'] as $key){
            (isset($get[$key]) && $get[$key] !== '') && $db->whereLike("m.{$key}","%{$get[$key]}%");
        }
        $db->join('system_family_seniority s','m.sid = s.id')->field('m.*,s.seniority')->order('id asc,sort asc');
        $this->assign('fid',$this->fid);
        return parent::_list($db,false);
    }

    /**
     * 家谱图
     */
    public function structure(){
        $this->title = "家族分支图谱";
        $branch_id = input('id','','intval');
        $back_url = 'admin.html#/admin/branch/index.html?fid='.$this->fid;
        (empty($branch_id)) && $this->error('分支ID不能为空',$back_url);
        $this->assign('fid',$this->fid);
        $this->assign('id',$branch_id);
        return view('',['title'=>$this->title]);
    }

}