<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:68:"D:\WWW\jiapu_baiqianwan_net/application/admin\view\branch.index.html";i:1644305051;s:69:"D:\WWW\jiapu_baiqianwan_net\application\extra\view\admin.content.html";i:1643863559;}*/ ?>
<div class="ibox">
    
    <?php if(isset($title)): ?>
    <div class="ibox-title notselect">
        <h5><?php echo $title; ?></h5>
        
<div class="nowrap pull-right" style="margin-top:10px">
    <button data-modal='<?php echo url("$classuri/edit"); ?>?fid=<?php echo $fid; ?>' data-title="添加分支" class='layui-btn layui-btn-small'>
        <i class='fa fa-plus'></i> 添加分支
    </button>
    <button data-update data-field='delete' data-action='<?php echo url("$classuri/del"); ?>?fid=<?php echo $fid; ?>' class='layui-btn layui-btn-small layui-btn-danger'>
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
        
<!-- 表单搜索 开始 -->
<form class="layui-form layui-form-pane form-search" action="__SELF__" onsubmit="return false" method="get">
    <div class="layui-form-item layui-inline">
        <label class="layui-form-label">分支姓名</label>
        <div class="layui-input-inline">
            <input name="name" value="<?php echo (\think\Request::instance()->get('name') ?: ''); ?>" placeholder="请输入分支姓名" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item layui-inline">
        <label class="layui-form-label">手机号</label>
        <div class="layui-input-inline">
            <input name="contact" value="<?php echo (\think\Request::instance()->get('contact') ?: ''); ?>" placeholder="请输入手机号" class="layui-input" pattern="^1[3-9][0-9]{9}$">
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
            <th class='text-center nowrap'>照片</th>
            <th class='text-center nowrap'>分支姓名</th>
            <th class='text-center nowrap'>家族名称</th>
            <th class='text-center nowrap'>字辈</th>
            <th class='text-center nowrap'>出生日期</th>
            <th class='text-center nowrap'>联系方式</th>
            <th class='text-center nowrap'>所在城市</th>
            <th class='text-center nowrap'>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($list as $key=>$vo): ?>
        <tr>
            <td class='list-table-check-td'>
                <input class="list-check-box" value='<?php echo $vo['id']; ?>' type='checkbox'/>
            </td>
            <td class='text-center nowrap'>
                <img data-tips-image src="<?php echo (isset($vo['avastar']) && ($vo['avastar'] !== '')?$vo['avastar']:'/static/theme/default/img/avastar.png'); ?>" width="50px" height="auto" />
            </td>
            <td class='text-center nowrap'>
                <?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>
            </td>
            <td class='text-center nowrap'>
                <?php echo (getFamilyName($vo['fid']) ?: "暂无"); ?>
            </td>
            <td class='text-center nowrap'>
                <?php echo (getSeniorityName($vo['sid']) ?: "暂无"); ?>
            </td>
            <td class='text-center nowrap'>
                <?php echo (isset($vo['birthday']) && ($vo['birthday'] !== '')?$vo['birthday']:"<span class='color-desc'>暂未设置</span>"); ?>
            </td>
            <td class='text-center nowrap'>
                <?php echo (isset($vo['contact']) && ($vo['contact'] !== '')?$vo['contact']:"<span class='color-desc'>暂未设置</span>"); ?>
            </td>
            <td class='text-center nowrap'>
                <?php echo (getRegionName($vo['province']) ?: "未设置"); ?>-<?php echo (getRegionName($vo['city']) ?: "未设置"); ?>
            </td>
            <td class='text-center' style="width: 250px">
                <?php if(auth("$classuri/detail")): ?>
                <span class="text-explode">|</span>
                <a data-open='<?php echo url("$classuri/detail"); ?>?id=<?php echo $vo['id']; ?>&fid=<?php echo $vo['fid']; ?>' href="javascript:void(0)">图谱</a>
                <?php endif; if(auth("$classuri/edit")): ?>
                <span class="text-explode">|</span>
                <a data-modal='<?php echo url("$classuri/edit"); ?>?id=<?php echo $vo['id']; ?>&fid=<?php echo $vo['fid']; ?>' href="javascript:void(0)">编辑</a>
                <?php endif; if(auth("$classuri/del")): ?>
                <span class="text-explode">|</span>
                <a data-update="<?php echo $vo['id']; ?>" data-field='delete' data-action='<?php echo url("$classuri/del"); ?>?fid=<?php echo $vo['fid']; ?>'
                   href="javascript:void(0)" data-confirm="确定要删除该家族分支吗?">删除</a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php if(isset($page)): ?><p><?php echo $page; ?></p><?php endif; endif; ?>
    <script>
        window.form.render();
    </script>
</form>

    </div>
    
</div>