<?php
namespace app\admin\controller;

use app\admin\model\BranchModel;
use controller\BasicAdmin;
use service\DataService;
use service\ToolsService;
use think\Db;
use think\Loader;
use think\Request;

/**
 *
 * Class Branch.php
 * @package app\admin\controller
 * @author 繁华如梦 <2398156504@qq.com>
 * @desc:家族分支成员管理
 * @date 2022/02/07 16:08
 */
class Branch extends BasicAdmin{
    public $table = "system_family_member";
    public $fid;

    public function __construct(Request $request = null){
        parent::__construct($request);
        $this->fid = $this->request->param('fid','0','intval');
        if(empty($this->fid)) $this->error("请从家族列表【更多】进入",'/admin.html#/admin/family/index.html');
        $this->assign('fid',$this->fid);
    }

    /**
     * 家族分支列表
     * @return array|string
     */
    public function index(){
        $this->title = "家族分支管理";
        $get = $this->request->get();
        $db = Db::name($this->table)->where(['fid'=>$this->fid,'pid'=>0,'is_deleted'=>0]);
        foreach (['name','contact'] as $key){
            (isset($get[$key]) && $get[$key] !== '') && $db->whereLike($key,"%{$get[$key]}%");
        }
        return parent::_list($db);
    }

    /**
     * 添加分支
     */
    public function edit(){
        return $this->_form($this->table,'form');
    }

    /**
     * 删除分支
     */
    public function del(){
        if(DataService::update($this->table)){
            $this->success('操作成功！','');
        }
        $this->error('操作失败,请重试！');
    }

    /**
     * 图谱管理
     */
    public function detail(){
        $this->title = "家族分支图谱";
        $branch_id = input('id','','intval');
        $back_url = 'admin.html#/admin/branch/index.html?fid='.$this->fid;
        (empty($branch_id)) && $this->error('分支ID不能为空',$back_url);

        $this->assign('fid',$this->fid);
        $this->assign('id',$branch_id);
        return view('',['title'=>$this->title]);
    }

    /**
     * 添加分支成员
     */
    public function add(){
        return $this->_form($this->table,'add');
    }

    /**
     * 获取结构化家谱
     */
    public function createStruct(){
        $branch_id = input('branch_id','','intval');
        $user = Db::name($this->table)->where(['is_deleted'=>0,'id'=>$branch_id])->field('id,pid,fid,sid,name,gender,avastar,contact,nexus')->find();
        $list = [];
        $model = new BranchModel();
        if(!empty($user)){
            $list = $model->getUserChildren($user);
        }
        array_unshift($list,$user);
        $lists = [];
        foreach ($list as $key=>$value){
            $lists[$key]['id'] = $value['id'];
            $lists[$key]['pid'] = $value['pid'];
            $lists[$key]['name'] = $value['name'];
            $lists[$key]['gender'] = ($value['gender'] == 2)?"女":"男";
            $lists[$key]['contact'] = $value['contact'];
            $lists[$key]['value'] = empty($value['sid'])?"":getSeniorityName($value['sid']);
            $lists[$key]['symbolSize'] = [80, 35];
            $lists[$key]['symbol'] = 'rectangle';
        }
        $users = ToolsService::arr2tree($lists,'id','pid','children');
        (!isset($users[0]['children'])) && $users[0]['children'] = [];
        return json($users[0]);
    }




    //--------以下内容请勿随意更改----------
    protected function _edit_form_filter(&$data){
        if($this->request->isPost()){
            $validate = Loader::validate('branch');
            if(!$validate->scene('branch')->check($data)){
                $this->error($validate->getError());
            }
            foreach (['name','birthday','deadtime','gender','contact','province','city','area','district','address'] as $key){
                if(isset($data[$key]) && $data[$key] == '') unset($data[$key]);
            }
        }else{
            //优化四级行政区域显示，减少地址选择
            if(empty($data['id'])){
                $provOpt = $this->buildCityOption(2);
                $this->assign('province',$provOpt);
            }else{
                $provOpt = $this->buildCityOption($data['province']);
                $cityOpt = $this->buildCityOption($data['city']);
                $areaOpt = $this->buildCityOption($data['area']);
                $streetOpt = $this->buildCityOption($data['district']);
                $this->assign('province',$provOpt);
                $this->assign('city',$cityOpt);
                $this->assign('area',$areaOpt);
                $this->assign('district',$streetOpt);
            }
        }
    }

    protected function _add_form_filter(&$data){
        if($this->request->isPost()){
            $validate = Loader::validate('branch');
            if(!$validate->scene('branch_member')->check($data)){
                $this->error($validate->getError());
            }
            foreach (['name','birthday','deadtime','gender','contact','province','city','area','district','address'] as $key){
                if(isset($data[$key]) && $data[$key] == '') unset($data[$key]);
            }
        }else{
            //优化四级行政区域显示，减少地址选择
            if(empty($data['id'])){
                $provOpt = $this->buildCityOption(2);
                $this->assign('province',$provOpt);
            }else{
                $provOpt = $this->buildCityOption($data['province']);
                $cityOpt = $this->buildCityOption($data['city']);
                $areaOpt = $this->buildCityOption($data['area']);
                $streetOpt = $this->buildCityOption($data['district']);
                $this->assign('province',$provOpt);
                $this->assign('city',$cityOpt);
                $this->assign('area',$areaOpt);
                $this->assign('district',$streetOpt);
            }
            //分支用户选项
            $branch_id = $this->request->get('branch_id','','intval');
            if(!empty($branch_id)){
                $model = new BranchModel();
                $user = Db::name($this->table)->where(['is_deleted'=>0,'id'=>$branch_id])->field('id,pid,fid,sid,name,gender,avastar,contact,nexus')->find();
                $list = $model->getUserChildren($user);
                array_unshift($list,$user);
                $options = $this->buildParentsOption($list,empty($data['pid'])?'':$data['pid']);
                $this->assign('parents',$options);
            }
        }
    }

    private function buildCityOption($aid = 0){
        $pid = Db::name("system_region")->where(['id'=>$aid])->value('pid');
        $data = '<option value="">请选择</option>'.PHP_EOL;
        if(!empty($pid)){
            $list = Db::name("system_region")->where(['pid'=>$pid])->field('id,pid,name,type')->order('id asc,sort asc')->select();
            foreach ($list as $key=>$value){
                if($value['id'] == $aid){
                    $data .= "<option value='".$value['id']."' selected=''>".$value['name']."</option>".PHP_EOL;
                }else{
                    $data .= "<option value='".$value['id']."'>".$value['name']."</option>".PHP_EOL;
                }
            }
        }
        return $data;
    }

    private function buildParentsOption($list,$pid=''){
        $data = '<option value="">请选择</option>'.PHP_EOL;
        foreach ($list as $key=>$value){
            if($value['id'] === $pid){
                $data .= "<option value='".$value['id']."' selected=''>".$value['name']."</option>".PHP_EOL;
            }else{
                $data .= "<option value='".$value['id']."'>".$value['name']."</option>".PHP_EOL;
            }
        }
        return $data;
    }




}