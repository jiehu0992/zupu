<?php
namespace app\admin\validate;
use think\Validate;
class Family extends Validate{
    //验证规则
    protected $rule = [
        'name'=>'require',
        'last_name'=>'require|chs',
        'ancestor'=>'chs',
    ];
    //验证消息
    protected $message = [
        'name.require'=>"家族名称不能为空",
        'last_name.require'=>"姓氏不能为空",
        'last_name.chs'=>"姓氏请填写汉字",
        'ancestor.chs'=>"始祖姓名请填写汉字",
    ];
    //验证场景
    protected $scene = [
        'family_info'=>['name','last_name','ancestor'],
    ];
}
