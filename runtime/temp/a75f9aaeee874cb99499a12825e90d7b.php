<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:69:"D:\WWW\jiapu_baiqianwan_net/application/admin\view\branch.detail.html";i:1644579826;s:69:"D:\WWW\jiapu_baiqianwan_net\application\extra\view\admin.content.html";i:1643863559;}*/ ?>
<div class="ibox">
    
    <?php if(isset($title)): ?>
    <div class="ibox-title notselect">
        <h5><?php echo $title; ?></h5>
        
<div class="nowrap pull-right" style="margin-top:10px">
    <button data-modal='<?php echo url("$classuri/add"); ?>?fid=<?php echo $fid; ?>&branch_id=<?php echo $id; ?>' data-title="添加成员" class='layui-btn layui-btn-small'>
        <i class='fa fa-plus'></i> 添加成员
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
        
<div id="mainStructure" style="min-height:500px;"></div>
<script src="/static/admin/echarts/chart/echarts.js"></script>
<script type="text/javascript">
    //Echarts CDN路径
    require.config({
        paths: {
            echarts: 'https://cdn.jsdelivr.net/npm/echarts@2.2.8/build'
        }
    });
    var bid = <?php echo $id; ?>;
    var fid = <?php echo $fid; ?>;
    require(['echarts','echarts/chart/tree'],function (ec) {
            // 基于准备好的dom，初始化echarts图表
            var myChart = ec.init(document.getElementById('mainStructure'));
            myChart.showLoading();
            $.post('<?php echo url("$classuri/createStruct"); ?>',{branch_id:bid,fid:fid},function (res) {
                console.log(res);
                var option = {
                    title : {
                        text: '家族分支图谱'
                    },
                    tooltip : {
                        show: true,
                        trigger: 'item',
                        formatter: function (v) {
                            var phone = v.contact == undefined?"无":v.contact
                            return "字辈:["+v.value+"]"+'<br/>'+"手机:"+phone;
                        },
                        textStyle: {
                            fontSize: 16,
                            fontFamily:'Microsoft YaHei',
                        }
                    },
                    toolbox: {
                        show : true,
                        feature : {
                            restore : {show: true},
                            saveAsImage : {show: true}
                        }
                    },
                    calculable : false,
                    series : [
                        {
                            name:'家族树',
                            type:'tree',
                            orient: 'vertical',  // vertical horizontal
                            rootLocation: {x: '50%', y: '15%'}, // 根节点位置  {x: 'center',y: 10}
                            nodePadding: 20,
                            layerPadding:40,
                            symbol: 'rectangle',
                            borderColor:'black',
                            itemStyle: {
                                normal: {
                                    color: '#fff',//节点背景色
                                    borderWidth: 2,
                                    borderColor: 'black',
                                    label: {
                                        show: true,
                                        position: 'inside',
                                        textStyle: {
                                            color: 'black',
                                            fontSize: 15,
                                            //fontWeight:  'bolder'
                                        }
                                    },
                                    lineStyle: {
                                        color: '#000',
                                        width: 1,
                                        type: 'broken' // 'curve'|'broken'|'solid'|'dotted'|'dashed'
                                    }
                                },
                                emphasis: {
                                    label: {
                                        show: false
                                    }
                                }
                            },
                            data:[res]
                        }
                    ]
                };
                // 为echarts对象加载数据
                myChart.hideLoading();
                myChart.setOption(option);
            })
        });
</script>

    </div>
    
</div>