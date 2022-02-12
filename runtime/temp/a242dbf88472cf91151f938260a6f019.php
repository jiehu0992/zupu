<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:68:"D:\WWW\jiapu_baiqianwan_net/application/admin\view\family.train.html";i:1644220350;}*/ ?>
<form class="layui-form layui-box" style='padding:25px 30px 20px 0' action="__SELF__" data-auto="true" method="post">
    <div class="layui-form-item">
        <label class="layui-form-label">家风家训</label>
        <div class="layui-input-block">
            <textarea name="train" required="required" class="layui-textarea"><?php echo (isset($vo['train']) && ($vo['train'] !== '')?$vo['train']:""); ?></textarea>
        </div>
    </div>

    <div class="hr-line-dashed"></div>
    <div class="layui-form-item text-center">
        <?php if(isset($vo['id'])): ?><input type='hidden' value='<?php echo $vo['id']; ?>' name='id'/><?php endif; ?>
        <button class="layui-btn" type='submit'>保存</button>
        <button class="layui-btn layui-btn-danger" type='button' data-confirm="确定要取消操作吗？" data-close>取消</button>
    </div>
    <script>
        window.form.render();
        require(['ckeditor'], function () {
            var editor = window.createEditor('[name="train"]',{
                resize_enabled: true,
                height:'450px'
            });
            var content = editor.getData();
            editor.sync(content);
        });
    </script>
</form>
