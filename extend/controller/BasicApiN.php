<?php
namespace controller;

use service\ToolsService;
use think\Request;
use think\Response;
use think\Controller;
/**
 *
 * Class BasicApiN.php
 * @package app\admin\controller
 * @author 繁华如梦 <2398156504@qq.com>
 * @desc:继承此控制器后，API无需登录即可跨域访问
 * @date 2022/2/8 13:03
 */
class BasicApiN extends Controller{

    /**
     * 访问请求对象
     * @var Request
     */
    public $request;

    /**
     * 当前访问身份
     * @var string
     */
    public $token;

    /**
     * 用户信息
     * @var array
     */
    public $UserInfo;


    /**
     * 基础接口SDK
     * @param Request|null $request
     */
    public function __construct(Request $request = null)
    {
        define('MODULE_NAME',request()->module());
        define('CONTROLLER_NAME',request()->controller());
        define('ACTION_NAME',request()->action());
        //请求对象
        ToolsService::corsRequestHander();
        $this->request = is_null($request) ? Request::instance() : $request;

        /**多语言处理
        $langType = empty($_COOKIE['think_var'])?Config::get('default_lang'):$_COOKIE['think_var'];
        Lang::load(APP_PATH . 'api/lang/'. $langType .'/'.strtolower( CONTROLLER_NAME ) .'.php' );
         */
    }

    /**
     * 输出返回数据
     * @param string $msg 提示消息内容
     * @param string $code 业务状态码
     * @param mixed $data 要返回的数据
     * @param string $type 返回类型 JSON XML
     * @return Response
     */
    public function response($code = 'SUCCESS',$msg, $data = [], $type = 'json')
    {
        $result = ['code' => $code,'msg' => $msg, 'data' => $data, 'type' => strtolower($type)];
        $response = Response::create($result, $type)->header(ToolsService::corsRequestHander())->code(200);
        return $response->send();
    }

}