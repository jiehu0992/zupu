<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:66:"D:\WWW\jiapu_baiqianwan_net/application/admin\view\branch.add.html";i:1644397171;}*/ ?>
<form class="layui-form layui-box" style='padding:25px 30px 20px 0;min-height: 400px' action="__SELF__" data-auto="true" method="post">
    <div class="layui-form-item">
        <label class="layui-form-label">照片</label>
        <div class='col-sm-8'>
            <img data-tips-image style="height:auto;max-height:100px;min-width:100px" src="<?php echo (isset($vo['avatar']) && ($vo['avatar'] !== '')?$vo['avatar']:'/static/theme/default/img/avastar.png'); ?>"/>
            <input type="hidden" name="avastar"  onchange="$(this).prev('img').attr('src', this.value)"
                   value="<?php echo (isset($vo['avastar']) && ($vo['avastar'] !== '')?$vo['avastar']:'/static/theme/default/img/avastar.png'); ?>" class="layui-input">
            <button class="layui-btn layui-btn-sm" data-file="one" data-type="jpg,png,gif" data-field="avastar" type="button">上传</button>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">姓名</label>
        <div class="layui-input-inline">
            <input name="name" value='<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:""); ?>' required="required" title="请输入分支姓名" placeholder="请输入分支姓名" class="layui-input">
        </div>
        <label class="layui-form-label">字辈</label>
        <div class="layui-input-inline">
            <select name="sid" lay-filter="sid" required="required">
                <?php if(isset($vo['sid'])): ?>
                <?php echo buildSeniorityOptions($vo['sid'],$vo['fid']); elseif(isset($fid)): ?>
                <?php echo buildSeniorityOptions(0,$fid); endif; ?>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">手机</label>
        <div class="layui-input-inline">
            <input name="contact" value='<?php echo (isset($vo['contact']) && ($vo['contact'] !== '')?$vo['contact']:""); ?>' title="请输入手机号码" placeholder="请输入手机号码" class="layui-input" pattern="^1(3|4|5|6|7|8|9)\d{9}$">
        </div>
        <label class="layui-form-label">性别</label>
        <div class="layui-input-inline">
            <select name="gender" lay-filter="gender">
                <option value="0" <?php if(isset($vo['gender']) and $vo['gender'] == 0): ?> selected="" <?php endif; ?>>请选择</option>
                <option value="1" <?php if(isset($vo['gender']) and $vo['gender'] == 1): ?> selected="" <?php endif; ?>>男</option>
                <option value="2" <?php if(isset($vo['gender']) and $vo['gender'] == 2): ?> selected="" <?php endif; ?>>女</option>
            </select>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">选择上级</label>
        <div class="layui-input-inline">
            <select name="pid" lay-filter="pid">
                <?php echo (isset($parents) && ($parents !== '')?$parents:'<option value="0">请选择</option>'); ?>
            </select>
        </div>
        <label class="layui-form-label">上级关系</label>
        <div class="layui-input-inline">
            <select name="nexus" lay-filter="nexus">
                <option value="0" <?php if(isset($vo['nexus']) and $vo['nexus'] == 0): ?> selected="" <?php endif; ?>>请选择</option>
                <option value="1" <?php if(isset($vo['nexus']) and $vo['nexus'] == 1): ?> selected="" <?php endif; ?>>子女</option>
                <option value="2" <?php if(isset($vo['nexus']) and $vo['nexus'] == 2): ?> selected="" <?php endif; ?>>配偶</option>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">出生日期</label>
        <div class="layui-input-inline">
            <input name="birthday" id="birthday" value="<?php echo (isset($vo['birthday']) && ($vo['birthday'] !== '')?$vo['birthday']:''); ?>" title="请选择出生日期" class="layui-input">
        </div>
        <label class="layui-form-label">离世日期</label>
        <div class="layui-input-inline">
            <input name="deadtime" id="deadtime" value="<?php echo (isset($vo['deadtime']) && ($vo['deadtime'] !== '')?$vo['deadtime']:''); ?>" title="请选择离世日期" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">住址</label>
        <div class="layui-input-inline" style="width: 150px;">
            <select name="province" lay-filter="province" data-value="<?php echo (isset($vo['province']) && ($vo['province'] !== '')?$vo['province']:''); ?>" id="province">
                <?php echo $province; ?>
            </select>
        </div>
        <div class="layui-input-inline" style="width: 150px;">
            <select name="city" lay-filter="city" data-value="<?php echo (isset($vo['city']) && ($vo['city'] !== '')?$vo['city']:''); ?>" id="city">
                <?php echo (isset($city) && ($city !== '')?$city:''); ?>
            </select>
        </div>
        <div class="layui-input-inline" style="width: 150px;">
            <select name="area" lay-filter="area" data-value="<?php echo (isset($vo['area']) && ($vo['area'] !== '')?$vo['area']:''); ?>" id="area">
                <?php echo (isset($area) && ($area !== '')?$area:''); ?>
            </select>
        </div>
        <div class="layui-input-inline" style="width: 150px;">
            <select name="district" lay-filter="district" data-value="<?php echo (isset($vo['district']) && ($vo['district'] !== '')?$vo['district']:''); ?>" id="district">
                <?php echo (isset($district) && ($district !== '')?$district:''); ?>
            </select>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">详细地址</label>
        <div class="layui-input-block">
            <input name="address" value='<?php echo (isset($vo['address']) && ($vo['address'] !== '')?$vo['address']:""); ?>'  class="layui-input" placeholder="请输入详细住址">
        </div>
    </div>

    <div class="hr-line-dashed"></div>
    <div class="layui-form-item text-center">
        <?php if(isset($vo['id'])): ?><input type='hidden' value='<?php echo $vo['id']; ?>' name='id'/><?php endif; ?>
        <input type='hidden' value='<?php echo (isset($vo['pid']) && ($vo['pid'] !== '')?$vo['pid']:"0"); ?>' name='pid'/>
        <?php if(isset($vo['fid'])): ?>
        <input type='hidden' value='<?php echo $vo['fid']; ?>' name='fid'/>
        <?php elseif(isset($fid)): ?>
        <input type='hidden' value='<?php echo $fid; ?>' name='fid'/>
        <?php endif; ?>
        <button class="layui-btn" type='submit'>保存</button>
        <button class="layui-btn layui-btn-danger" type='button' data-confirm="确定要取消操作吗？" data-close>取消</button>
    </div>
    <script>
        window.form.render();
        //阻止多个日期点击冒泡事件
        $("#birthday").on("click",function(){
            laydate.render({
                elem:'#birthday',format:'yyyy-MM-dd',closeStop:'#birthday',value:this.value
            })
        })
        $("#deadtime").on("click",function(){
            laydate.render({
                elem:'#deadtime',format:'yyyy-MM-dd',closeStop:'#deadtime',value:this.value
            })
        })
        //行政区域联动选择功能
        layui.use(['form'],function () {
            var form = layui.form;
            form.on('select(province)',function (data) {
                var prov = data.value;
                $.post('<?php echo url("@api/index/getCityOptions"); ?>',{"area_id":prov},function (ret) {
                    $("#city").empty();
                    $("#area").empty();
                    $("#district").empty();
                    $("#city").append(ret);
                    window.form.render();
                })
            })
            form.on('select(city)',function (data) {
                var city = data.value;
                $.post('<?php echo url("@api/index/getCityOptions"); ?>',{"area_id":city},function (ret) {
                    $("#area").empty();
                    $("#district").empty();
                    $("#area").append(ret);
                    window.form.render();
                })
            })
            form.on('select(area)',function (data) {
                var area = data.value;
                $.post('<?php echo url("@api/index/getCityOptions"); ?>',{"area_id":area},function (ret) {
                    $("#district").empty();
                    $("#district").append(ret);
                    window.form.render();
                })
            })
        });
        //行政区域默认赋值问题
        $(function () {
            $("#province").val($("#province").attr("data-value"));
            $("#city").val($("#city").attr("data-value"));
            $("#area").val($("#area").attr("data-value"));
            $("#district").val($("#district").attr("data-value"));
        })
    </script>
</form>
