/*
*根据Json创建Form表单
* i:元素ID;s:Json数据
* 页面需加载Jquery库
* Created By BoBo 2021
 */

function createElementByJson(i,s) {
    console.log("初始化表单开始...");
    if('' == s){
        console.log('Json字符不能为空');
        return false;
    }
    var tpl='';
    $.each(JSON.parse(s),function (index,data) {
        tpl += getFormTpl(data.type,data.title,data.name,data.value);
    })
    //return data;
    $(tpl).hide().appendTo($('#'+i)).fadeIn('slow');
    console.log("表单初始化结束");
    //如果页面注册有Form组件，否则必须注释掉；
    window.form.render();
}

//获取Form模板
function getFormTpl(type,input_title,input_name,input_val=''){
    var data = '';
    var tpl = "$(this).prev('img').attr('src', this.value)";
    var tpl_del = '<div class="layui-form-mid layui-word-aux">\n' +
        '            <button type="button" class="layui-btn layui-btn-primary layui-btn-xs delete"><i class="fa fa-close"></i></button>\n' +
        '        </div>';
    var tpl_img = '<div class="layui-form-item">\n' +
        '        <label class="layui-form-label">'+ input_title +'</label>\n' +
        '        <div class="layui-input-block">\n' +
        '            <div class="layui-input-inline">\n'+
        '                <img data-tips-image style="height:auto;max-height:100px;min-width:100px" src="/static/theme/default/img/image.png"/>\n' +
        '                <input type="hidden" name="' + input_name + '"  onchange="'+ tpl +'"\n' +
        '                   value="'+ input_val +'" class="layui-input" cate="images">\n' +
        '                <button class="layui-btn layui-btn-sm" data-file="one" data-type="jpg,png,gif" data-field="' + input_name + '" type="button">上传</button>\n' +
        '            </div>\n'+
        '        </div>\n' +tpl_del+
        '    </div>';
    var tpl_file = '<div class="layui-form-item">\n' +
        '        <label class="layui-form-label">'+ input_title +'</label>\n' +
        '        <div class="layui-input-block" style="min-height: 0px">\n' +
        '            <div class="layui-input-inline" style="width: 300px">\n' +
        '                <input class="layui-input" name="' + input_name + '" placeholder="请上传附件..." value="'+ input_val +'" cate="files">\n' +
        '            </div>\n' +
        '            <div class="layui-input-inline">\n' +
        '                <button type="button" class="layui-btn layui-btn-small layui-btn-radius" data-file="one" data-type="doc,ppt,txt,docx,pptx,zip" data-uptype="local" data-field="' + input_name + '">\n' +
        '                    <i class="fa fa-cloud-upload"></i>上传\n' +
        '                </button>\n' +
        '            </div>\n' +
        '        </div>\n' +tpl_del+
        '    </div>';
    var tpl_text = '<div class="layui-form-item">\n' +
        '        <label class="layui-form-label">'+input_title+'</label>\n' +
        '        <div class="layui-input-inline">\n' +
        '            <input name="'+input_name+'" value="'+ input_val +'"  class="layui-input" title="请输入中文或英文字母" pattern="^[u4E00-u9FA5A-Za-z0-9_]+$" cate="text">\n' +
        '        </div>\n' +tpl_del+
        '    </div>';
    var tpl_numandmoney = '<div class="layui-form-item">\n' +
        '        <label class="layui-form-label">'+input_title+'</label>\n' +
        '        <div class="layui-input-inline">\n' +
        '            <input name="'+input_name+'" type="text" value="'+ input_val +'"  class="layui-input" title="请输入数字" pattern="(^[1-9]([0-9]+)?(\\.[0-9]{1,2})?$)|(^(0){1}$)|(^[0-9]\\.[0-9]([0-9])?$)" cate="numbers">\n' +
        '        </div>\n' +tpl_del+
        '    </div>';
    var tpl_datetime = '<div class="layui-form-item">\n' +
        '        <label class="layui-form-label">'+input_title+'</label>\n' +
        '        <div class="layui-input-inline">\n' +
        '            <input name="'+input_name+'" type="datetime" value="'+ input_val +'"  class="layui-input" title="格式：2021-02-02 15:30:00" pattern="^[1-9]\\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])\\s+(20|21|22|23|[0-1]\\d):[0-5]\\d:[0-5]\\d$" cate="datetimes">\n' +
        '        </div>\n' +tpl_del+
        '    </div>';
    switch (type) {
        case "images":
            data = tpl_img;
            break;
        case "files":
            data = tpl_file;
            break;
        case "moneys":
            data = tpl_numandmoney;
            break;
        case "numbers":
            data = tpl_numandmoney;
            break;
        case "datetimes":
            data = tpl_datetime;
            break;
        default:
            data = tpl_text;
            break;
    }
    return data;
}