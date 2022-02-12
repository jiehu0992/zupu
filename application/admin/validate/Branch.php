<?php
namespace app\admin\validate;
use think\Validate;
class Branch extends Validate{
    //验证规则
    protected $rule = [
        'name'=>'require|chs',
        'fid'=>'require|integer|gt:0',
        'pid'=>'require|integer',
        'birthday'=>'date',
        'deadtime'=>'date',
        'gender'=>'integer|in:0,1,2',
        'contact'=>'regex:mobile'
    ];
    //验证消息
    protected $message = [
        'name.require'=>"姓名不能为空",
        'name.chs'=>"请输入中文姓名",
        'fid.require'=>"家族ID不能为空",
        'fid.integer'=>"家族ID参数有误",
        'fid.gt'=>"家族ID取值有误",
        'pid.require'=>"父级ID不能为空",
        'pid.integer'=>"父级ID参数有误",
        'birthday.date'=>"出生日期有误",
        'deadtime.date'=>"离世日期有误",
        'gender.integer'=>"性别参数有误",
        'gender.in'=>"性别参数取值有误",
        'contact.regex'=>"请输入正确的手机号",
    ];
    //扩展规则
    protected $regex = [
        'mobile'=>"/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|16[6]|(17[0,3,5-8])|(18[0-9])|19[89])\d{8}$/",
        'img'=>"/^(data:\s*image\/(\w+);base64,)/",
        'telphone'=>"/^(?:(0\d{2,3}-)?\d{7,8}|1[3-9]\d{9})$/",
    ];
    //验证场景
    protected $scene = [
        'branch'=>['name','fid','pid','birthday','deadtime','gender','contact'],
    ];
}
