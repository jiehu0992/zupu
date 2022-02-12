<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:71:"D:\WWW\jiapu_baiqianwan_net/application/admin\view\seniority.index.html";i:1644215855;s:69:"D:\WWW\jiapu_baiqianwan_net\application\extra\view\admin.content.html";i:1643863559;}*/ ?>
<div class="ibox">
    
    <?php if(isset($title)): ?>
    <div class="ibox-title notselect">
        <h5><?php echo $title; ?></h5>
        
<div class="nowrap pull-right" style="margin-top:10px">
    <button data-open='/admin.html#/admin/family/index.html' class='layui-btn layui-btn-small'><i
            class='fa fa-mail-reply-all'></i> 返回家族
    </button>
    <button data-modal='<?php echo url("$classuri/edit"); ?>?fid=<?php echo $fid; ?>' data-title="添加字辈" class='layui-btn layui-btn-small'><i
            class='fa fa-plus'></i> 添加字辈
    </button>
    <button data-update data-field='delete' data-action='<?php echo url("$classuri/del"); ?>'
            class='layui-btn layui-btn-small layui-btn-danger'><i class='fa fa-remove'></i> 删除字辈
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
        

<form onsubmit="return false;" data-auto="true" method="post">
    <input type="hidden" value="resort" name="action"/>
    <table class="layui-table" lay-skin="line" lay-size="sm">
        <thead>
        <tr>
            <th class='list-table-check-td'>
                <input data-none-auto="" data-check-target='.list-check-box' type='checkbox'/>
            </th>
            <th class='list-table-sort-td'>
                <button type="submit" class="layui-btn layui-btn-normal layui-btn-mini">排 序</button>
            </th>
            <th class='text-center'>字辈</th>
            <th class='text-center'>家族</th>
            <th class='text-center'>状态</th>
            <th class='text-center'>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($list as $key=>$vo): ?>
        <tr>
            <td class='list-table-check-td'>
                <input class="list-check-box" value='' type='checkbox'/>
            </td>
            <td class='list-table-sort-td'>
                <input name="_<?php echo $vo['id']; ?>" value="<?php echo $vo['sort']; ?>" class="list-sort-input"/>
            </td>
            <td class='text-center'><?php echo (isset($vo['seniority']) && ($vo['seniority'] !== '')?$vo['seniority']:"暂无"); ?></td>
            <td class='text-center'><?php echo (getFamilyName($vo['fid']) ?: "暂无"); ?></td>
            <td class='text-center'>
                <?php if($vo['status'] == 0): ?>
                <span><a data-update="<?php echo $vo['id']; ?>" data-field='status' data-value='1' data-action='<?php echo url("$classuri/del"); ?>'>已禁用</a></span>
                <?php elseif($vo['status'] == 1): ?>
                <span style="color:#090"><a data-update="<?php echo $vo['id']; ?>" data-field='status' data-value='0' data-action='<?php echo url("$classuri/del"); ?>'>使用中</a></span>
                <?php endif; ?>
            </td>
            <td class='text-center nowrap'>
                <?php if(auth("$classuri/edit")): ?>
                <span class="text-explode">|</span>
                <a data-modal='<?php echo url("$classuri/edit"); ?>?id=<?php echo $vo['id']; ?>&fid=<?php echo $vo['fid']; ?>' href="javascript:void(0)">编辑</a>
                <?php endif; if(auth("$classuri/del")): ?>
                <span class="text-explode">|</span>
                <a data-update="<?php echo $vo['id']; ?>" data-field='delete' data-action='<?php echo url("$classuri/del"); ?>&fid=<?php echo $vo['fid']; ?>'
                   href="javascript:void(0)">删除</a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</form>

    </div>
    
</div>