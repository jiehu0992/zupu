<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:67:"D:\WWW\jiapu_baiqianwan_net/application/admin\view\family.form.html";i:1644209413;}*/ ?>
<form class="layui-form layui-box" style='padding:25px 30px 20px 0' action="__SELF__" data-auto="true" method="post">
    <div class="layui-form-item">
        <label class="layui-form-label">家族名称</label>
        <div class="layui-input-block">
            <input name="name" value='<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:""); ?>'  class="layui-input" title="请输入家族名称" placeholder="请输入家族名称" required="required">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">家族姓氏</label>
        <div class="layui-input-inline">
            <input name="last_name" value='<?php echo (isset($vo['last_name']) && ($vo['last_name'] !== '')?$vo['last_name']:""); ?>'  class="layui-input" title="请输入家族姓氏" placeholder="请输入家族姓氏" required="required">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">始祖姓名</label>
        <div class="layui-input-inline">
            <input name="ancestor" value='<?php echo (isset($vo['ancestor']) && ($vo['ancestor'] !== '')?$vo['ancestor']:""); ?>'  class="layui-input" title="请输入始祖姓名" placeholder="请输入始祖姓名">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">家族房系</label>
        <div class="layui-input-inline">
            <input name="faction" value='<?php echo (isset($vo['faction']) && ($vo['faction'] !== '')?$vo['faction']:""); ?>'  class="layui-input" title="请输入家族房系" placeholder="请输入家族房系">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">发源地</label>
        <div class="layui-input-block">
            <input name="origin_addr" value='<?php echo (isset($vo['origin_addr']) && ($vo['origin_addr'] !== '')?$vo['origin_addr']:""); ?>'  class="layui-input" title="请输入家族发源地" placeholder="请输入家族发源地">
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="layui-form-item text-center">
        <?php if(isset($vo['id'])): ?><input name="id" value="<?php echo $vo['id']; ?>" type="hidden" /><?php endif; ?>
        <button class="layui-btn" type='submit' >保存数据</button>
        <button class="layui-btn layui-btn-danger" type='button' data-confirm="确定要关闭窗口吗？" data-close>关闭</button>
    </div>
    <script>window.form.render();</script>
</form>
