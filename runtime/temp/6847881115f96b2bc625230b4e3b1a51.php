<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:68:"D:\WWW\jiapu_baiqianwan_net/application/admin\view\family.index.html";i:1644239577;s:69:"D:\WWW\jiapu_baiqianwan_net\application\extra\view\admin.content.html";i:1643863559;}*/ ?>
<div class="ibox">
    
    <?php if(isset($title)): ?>
    <div class="ibox-title notselect">
        <h5><?php echo $title; ?></h5>
        
<div class="nowrap pull-right" style="margin-top:10px">
    <button data-modal='<?php echo url("$classuri/edit"); ?>' data-title="添加家族" class='layui-btn layui-btn-small'>
        <i class='fa fa-plus'></i> 添加家族
    </button>
    <button data-update data-field='delete' data-action='<?php echo url("$classuri/del"); ?>' class='layui-btn layui-btn-small layui-btn-danger'>
        <i class='fa fa-remove'></i> 删除家族
    </button>
</div>

    </div>
    <?php endif; ?>
    <div class="ibox-content">
        <?php if(isset($alert)): ?>
        <div class="alert alert-<?php echo $alert['type']; ?> alert-dismissible" role="alert" style="border-radius:0">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <?php if(isset($alert['title'])): ?><p style="font-size:18px;padding-bottom:10px"><?php echo $alert['title']; ?></p><?php endif; if(isset($alert['content'])): ?><p style="font-size:14px"><?php echo $alert['content']; ?></p><?php endif; ?>
        </div>
        <?php endif; ?>
        
<style>
    .slide-submenu{
        position: absolute;
        width: 100px;
        color: #333;
        background: #fff;
        z-index: 800;
        padding: 0px 0;
        right: -60px;
        top: 18px;
        border-top: 1px solid #e0e0e0;
        display: none;
    }
    .slide-submenu a{
        line-height: 30px;
        padding: 0 15px;
        display: block;
        font-size: 14px;
    }
    .slide-submenu a:hover{
        background: #fafafa;
    }
    .more:hover .slide-submenu{
        display: block;
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/microanswer/layui_dropdown@2.3.3/dist/dropdown.css" media="all">
<!-- 表单搜索 开始 -->
<form class="layui-form layui-form-pane form-search" action="__SELF__" onsubmit="return false" method="get">
    <div class="layui-form-item layui-inline">
        <label class="layui-form-label">家族名称</label>
        <div class="layui-input-inline">
            <input name="name" value="<?php echo (\think\Request::instance()->get('name') ?: ''); ?>" placeholder="请输入家族名称" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item layui-inline">
        <label class="layui-form-label">姓氏</label>
        <div class="layui-input-inline">
            <input name="last_name" value="<?php echo (\think\Request::instance()->get('last_name') ?: ''); ?>" placeholder="请输入姓氏" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item layui-inline">
        <label class="layui-form-label">始祖姓名</label>
        <div class="layui-input-inline">
            <input name="ancestor" value="<?php echo (\think\Request::instance()->get('ancestor') ?: ''); ?>" placeholder="请输入始祖姓名" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item layui-inline">
        <label class="layui-form-label">更新时间</label>
        <div class="layui-input-inline">
            <input name="date" id='range-date' value="<?php echo (\think\Request::instance()->get('date') ?: ''); ?>"
                   placeholder="请选择最新更新时间" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item layui-inline">
        <button class="layui-btn layui-btn-primary"><i class="layui-icon">&#xe615;</i> 搜 索</button>
    </div>
</form>
<!-- 表单搜索 结束 -->

<form onsubmit="return false;" data-auto="true" method="post">
    <?php if(empty($list)): ?>
    <p class="help-block text-center well">没 有 记 录 哦！</p>
    <?php else: ?>
    <input type="hidden" value="resort" name="action"/>
    <table class="layui-table" lay-skin="line" lay-size="sm">
        <thead>
        <tr>
            <th class='list-table-check-td'>
                <input data-none-auto="" data-check-target='.list-check-box' type='checkbox'/>
            </th>
            <th class='text-left nowrap'>家族名称</th>
            <th class='text-left nowrap'>姓氏</th>
            <th class='text-left nowrap'>始祖姓名</th>
            <th class='text-left nowrap'>房系</th>
            <th class='text-left nowrap'>修谱时间</th>
            <th class='text-left nowrap'>更新时间</th>
            <th class='text-left nowrap'>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($list as $key=>$vo): ?>
        <tr>
            <td class='list-table-check-td'>
                <input class="list-check-box" value='<?php echo $vo['id']; ?>' type='checkbox'/>
            </td>
            <td class='text-left nowrap'>
                <?php echo $vo['name']; ?>
            </td>
            <td class='text-left nowrap'>
                <?php echo (isset($vo['last_name']) && ($vo['last_name'] !== '')?$vo['last_name']:"<span class='color-desc'>还没有设置姓氏</span>"); ?>
            </td>
            <td class='text-left nowrap'>
                <?php echo (isset($vo['ancestor']) && ($vo['ancestor'] !== '')?$vo['ancestor']:"<span class='color-desc'>不详</span>"); ?>
            </td>
            <td class='text-left nowrap'>
                <?php echo (isset($vo['faction']) && ($vo['faction'] !== '')?$vo['faction']:"<span class='color-desc'>暂未设置</span>"); ?>
            </td>
            <td class='text-left nowrap'>
                <?php echo (isset($vo['addtime']) && ($vo['addtime'] !== '')?$vo['addtime']:""); ?>
            </td>
            <td class='text-left nowrap'>
                <?php echo (isset($vo['uptime']) && ($vo['uptime'] !== '')?$vo['uptime']:""); ?>
            </td>
            <td class='text-left' style="width: 250px">
                <?php if(auth("$classuri/edit")): ?>
                <span class="text-explode">|</span>
                <a data-modal='<?php echo url("$classuri/edit"); ?>?id=<?php echo $vo['id']; ?>' href="javascript:void(0)">编辑</a>
                <?php endif; if(auth("$classuri/del")): ?>
                <span class="text-explode">|</span>
                <a data-update="<?php echo $vo['id']; ?>" data-field='delete' data-action='<?php echo url("$classuri/del"); ?>'
                   href="javascript:void(0)">删除</a>
                <?php endif; ?>
                <span>|</span>
                <span class="nav-list" style="display: inline-block;text-decoration: none;cursor: pointer;position: relative">
                    <a class="more" href="javascript:;" data-value="<?php echo $vo['id']; ?>">更多&#9660;</a>
                    <ul class="slide-submenu qy-box">
                        <?php if(auth("/admin/family/train")): ?><a data-open='<?php echo url("/admin/family/train"); ?>?id=<?php echo $vo['id']; ?>' href="javascript:void(0)" data-title="家风家训">家风家训</a><?php endif; if(auth("/admin/seniority/index")): ?><a data-open='<?php echo url("/admin/seniority/index"); ?>?fid=<?php echo $vo['id']; ?>' href="javascript:void(0)" data-title="字辈设置">字辈设置</a><?php endif; if(auth("/admin/branch/index")): ?><a data-open='<?php echo url("/admin/branch/index"); ?>?fid=<?php echo $vo['id']; ?>' href="javascript:void(0)" data-title="分支管理">分支管理</a><?php endif; ?>
                    </ul>
                </span>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php if(isset($page)): ?><p><?php echo $page; ?></p><?php endif; endif; ?>
    <script>
        window.form.render();
        window.laydate.render({range: true, elem: '#range-date', format: 'yyyy/MM/dd'});
        layui.use(['jquery'],function (){
            var $ = layui.jquery;
            //更多操作的下拉菜单
            $('.more').hover(
                function(){
                    $(this).next('.qy-box').show();
                },
                function(){
                    $(this).next('.qy-box').hide();
                },
            );
            //防止鼠标移动过慢无法点击下拉菜单
            $('.slide-submenu').hover(
                function (){
                    $(this).show();
                },
                function (){
                    $(this).hide();
                }
            )
        })
    </script>
</form>

    </div>
    
</div>