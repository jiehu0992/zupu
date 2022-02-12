<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:70:"D:\WWW\jiapu_baiqianwan_net/application/admin\view\seniority.form.html";i:1644214380;}*/ ?>
<form class="layui-form layui-box" style='padding:25px 30px 20px 0' action="__SELF__" data-auto="true" method="post">

    <div class="layui-form-item">
        <label class="layui-form-label">字辈名称</label>
        <div class="layui-input-inline">
            <input autofocus name="seniority" value='<?php echo (isset($vo['seniority']) && ($vo['seniority'] !== '')?$vo['seniority']:""); ?>' title="请输入字辈名" placeholder="请输入字辈名" class="layui-input">
        </div>
    </div>
    <div class="hr-line-dashed"></div>

    <div class="layui-form-item text-center">
        <?php if(isset($vo['fid'])): ?><input type='hidden' value='<?php echo $vo['fid']; ?>' name='fid'/>
        <?php elseif(isset($fid)): ?><input type='hidden' value='<?php echo $fid; ?>' name='fid'/><?php endif; ?>
        <button class="layui-btn" type='submit'>保存数据</button>
        <button class="layui-btn layui-btn-danger" type='button' data-confirm="确定要取消编辑吗？" data-close>取消编辑</button>
    </div>
    <script>window.form.render();</script>
</form>
