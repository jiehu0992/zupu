<?php
namespace app\admin\controller;

use controller\BasicAdmin;
use service\DataService;
use think\Db;
use think\Loader;

/**
 *
 * Class Family.php
 * @package app\admin\controller
 * @author 繁华如梦 <2398156504@qq.com>
 * @desc:家族管理
 * @date 2022/02/07 13:08
 */
class Family extends BasicAdmin{
    public $table = "system_family";

    /**
     * 家族列表
     */
    public function index(){
        $this->title = "家族管理";
        $get = $this->request->get();
        $db = Db::name($this->table)->where(['is_deleted'=>0]);
        foreach (['name','last_name','ancestor'] as $key){
            (isset($get[$key]) && $get[$key] !== '') && $db->whereLike($key,"%{$get[$key]}%");
        }
        if (isset($get['date']) && $get['date'] !== '') {
            list($start, $end) = explode('-', str_replace(' ', '', $get['date']));
            $db->whereBetween('uptime', ["{$start} 00:00:00", "{$end} 23:59:59"]);
        }
        return parent::_list($db->order('id desc'));
    }

    /**
     * 添加与修改家族信息
     */
    public function edit(){
        return $this->_form($this->table,'form');
    }

    /**
     * 删除家族
     */
    public function del(){
        //删除时需要确认，确认后检查家族下是否有数据。
        /**
        if(DataService::update($this->table)){
            $this->success('操作成功！','');
        }
         */
        $this->error('操作失败,请重试');
    }

    /**
     * 家风家训
     */
    public function train(){
        return $this->_form($this->table,'train');
    }

    //------以下内容请勿擅自修改-------
    protected function _edit_form_filter(&$data){
        if($this->request->isPost()){
            $validate = Loader::validate('family');
            if(!$validate->scene('family_info')->check($data)){
                $this->error($validate->getError());
            }
            $data['uptime'] = getDT();
            (empty($data['id'])) && $data['addtime'] = $data['uptime'];
        }
    }

    protected function _train_form_filter(&$data){
        if($this->request->isPost()){
            (empty($data['id'])) && $this->error('家族ID不能为空');
            $data['uptime'] = getDT();
        }
        (empty($data['id'])) && $this->error('请从家族列表【更多】进入','/admin.html#/admin/family/index.html');
    }




}
