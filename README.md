简易家谱管理系统
--
* 简易家谱管理系统源于一个朋友的需求而开发，内核采用ThinkPHP5，底层框架沿用波波的另一开源项目[TP-admin](https://gitee.com/zkii_admin/Tp-admin "TP-admin")，前端引入库为layui和echarts。
* 项目安装及二次开发请参考 ThinkPHP 官方文档及下面的服务环境说明，数据库 sql 文件存放于项目根目录下。
> 注意：项目测试请另行搭建环境并创建数据库（数据库配置 application/database.php）, 切勿直接使用测试环境数据！


开发文档
--
本项目相关开发文档：http://doc.zkii.net/web/#/4?page_id=21

项目界面预览：https://www.zkii.net/code/webcode/4585.html

如有问题可以直接QQ：2398156504


主要功能
--
* 家族管理。
* 字辈设置。
* 家风家训管理。
* 图谱自动生成。
* 家族分支管理及分支成员的添加设置。
* 家族树形表格，更加方便家谱打印、信息修改、成员排序 --2022/05/10更新

未完成的功能
--
* 小程序端/APP端

如果有精于前端开发的小伙伴欢迎随时参与本项目的前端开发，本项目承诺永久免费开源。

如需API接口支持可添加QQ：2398156504

配置环境
---
>1. PHP 版本不低于 PHP5.4，推荐使用 PHP7 以达到最优效果；
>2. 需开启 PATHINFO，不再支持 ThinkPHP 的 URL 兼容模式运行（源于如何优雅的展示）。

* Apache

```xml
<IfModule mod_rewrite.c>
  Options +FollowSymlinks -Multiviews
  RewriteEngine On
  RewriteCond %{REQUEST_FILENAME} !-d
  RewriteCond %{REQUEST_FILENAME} !-f
  RewriteRule ^(.*)$ index.php?/$1 [QSA,PT,L]
</IfModule>
```

* Nginx

```
location / {
	if (!-e $request_filename){
		rewrite  ^(.*)$  /index.php?s=$1  last;   break;
	}
}
```

版权说明
--
* ThinkAdmin 基于`MIT`协议发布，任何人可以用在任何地方，不受约束
* 底层框架部分代码来自互联网，若有异议，可以联系作者进行删除


鸣谢
--
* ThinkAdmin开发团队
* ThinkPHP开发团队
* Layui前端
* Echarts图表

打赏
--
<img src="static/theme/default/img/qrcode.png"  width="400">