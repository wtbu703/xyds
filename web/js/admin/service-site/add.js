// 加载字典信息
$(document).ready(function(){
    generateDict('DICT_COUNTYTYPE','type','类型');
    //generateState();
});
//生成状态下拉框
/*function generateState(){
    var dictArray = [];
    dictArray.push("<option value=''><--请选择类型--></option>");
    $.ajax({
        url:listdictUrl,
        type:"post",
        dataType:"json",
        data:"dictCode=DICT_COUNTYTYPE",
        async:false,
        success:function(data){
            $.each(data,function(i,n){
                dictArray.push("<option value='"+ n.dictItemCode +"'>"+ n.dictItemName +"</option>");
            });
            $('#type').html(dictArray.join(''));
        },
        error:function (data) {
            window.top.art.dialog({content:'加载字典组出错！',lock:true,width:'250',height:'50',border: false,time:1.5},function(){});
        }
    });

}*/

//页面校验
$(function() {
    $.formValidator.initConfig({ formID: "myform",autotip:true, onError: function () { alert("校验没有通过，具体错误请看错误提示") } });

    // 校验模型名称
    var code;
    code = 'oldCode=null';
    $("#code").formValidator({
        onshow: "（长度不超过16）",
        onfocus: "编码不能超过16",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min: 1,
        onerror: "请输入站点编码！"
    }).ajaxValidator({					// 校验不许重复
        type: "post",
        url: checkCodeUrl,
        data: code,
        datatype: "text",
        async: 'true',
        success: function (data) {
            return data != "exist";
        },
        buttons: $("#dosubmit"),  // 页面提示----"输入正确"
        onerror: "站点编码已存在",
        onwait: "正在连接，请稍候。"
    });
	$("#name").formValidator({
        onshow: "（必填）",
        onfocus: "站点名称不超过16个字",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入站点名称！"
    }).regexValidator({
        regexp:"^.{1,16}$",
        onerror:"不能超过16个字"
    });
    $("#type").formValidator({
        onshow: "（必填）",
        onfocus: "（必填）请选择选项",
        oncorrect: "（正确）"
    }).inputValidator({
        min: 1,  //开始索引
        onerror: "请选择站点类型!"
    });
    $("#chargeName").formValidator({
        onshow: "（必填）",
        onfocus: "不能超过8个字",
        oncorrect: "（正确）"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"请输入负责人姓名！"
    }).regexValidator({
        regexp:"^[\\u4E00-\\u9FA5A-Za-z0-9]{1,8}$",
        onerror:"不能超过8个字"
    });
    $("#chargeMobile").formValidator({
        onshow: "（必填）",
        onfocus: "例如：13312345678",
        oncorrect: "（正确）"})
		.inputValidator({               //校验不能为空
			min:1,
			onerror:"请输入联系电话！"})
		.regexValidator({
            regexp:"^1(3|4|5|7|8)\\d{9}$",
            param:'i',
            onerror:"联系电话填写不对！"
    });
    $("#address").formValidator({
            onshow: "（必填）",
            onfocus: "地址最多64个字",
            oncorrect: "（正确）"})
        .inputValidator({               //校验不能为空
            min:1,
            onerror:"请输入联系电话！"})
        .regexValidator({
            regexp:"^.{1,64}$",
            param:'i',
            onerror:"地址最多64个字！"
        });
});


/**
 * 添加过滤
 * @return
 */
function add(){
	if($.formValidator.pageIsValid()){ // 表单提交进行校验
		var paraStr;
		paraStr = "code=" + $('#code').val() + "&name=" + $('#name').val() + "&type=" + $('#type').val() + "&chargeName=" + $('#chargeName').val()+ "&chargeMobile=" + $('#chargeMobile').val()+ "&address=" + $('#address').val()+ "&attachUrls=" + $('#attachUrls').val()+"&longitude="+x+"&latitude="+y;
		$.ajax({
			url: saveUrl,
			type: "post",
			dataType: "text",
			data:paraStr ,
			async: "false",
			success: function (data) {
				if(data == "success"){
					window.top.art.dialog({
						content: '添加成功！',
						lock: true,
						width: 250,
						height: 80,
						border: false,
						time: 2
					}, function () {
					});
                    art.dialog.parent.location.href = indexUrl;
					window.top.$.dialog.get('site_add').close();
				}else{
					window.top.art.dialog({
						content: '添加失败！',
						lock: true,
						width: 250,
						height: 80,
						border: false,
						time: 2
					}, function () {
					});
				}
			},
			error:function(){
				window.top.art.dialog({
					content: '添加失败！',
					lock: true,
					width: 250,
					height: 80,
					border: false,
					time: 2
				}, function () {
				});
			}
		});

	}
}

/*百度地图*/
    var map = new BMap.Map("allmap");
    
   
    map.enableKeyboard();//启动键盘操作地图
    var point = new BMap.Point(107.55214,33.22866); //陕西省汉中市洋县
    map.centerAndZoom(point, 14);
    map.disableDoubleClickZoom(true);
    var temPoi;
    var name = document.getElementById('name');
    var chargeName = document.getElementById('chargeName');
    var chargeMobile = document.getElementById('chargeMobile');
    var address = document.getElementById('address');
    var addInfo = document.getElementsByClassName('buttonsave')[0];
    var x,y;
    var $addBiaozhu = $('#addBiaozhu'); 
    var popt = 0;  
    var cursorFly = document.getElementById("divFly");

    $addBiaozhu.click(function(){
         popt = 0;
        map.setDefaultCursor('pointer');
        document.onmousemove = DivFlying;
        cursorFly.style.display = 'block';
        map.addEventListener("click", function(e) {
            if(popt == 0){
                temPoi = new BMap.Point(e.point.lng, e.point.lat);
                var marker = new BMap.Marker(temPoi); // 创建点
                map.addOverlay(marker); 
                marker.setLabel(new BMap.Label('右键删除',{offset:new BMap.Size(20,-10)}));
                x = e.point.lng;
                y = e.point.lat;
                popt = 1;
                map.setDefaultCursor('default');
                cursorFly.style.display = 'none';
                //右键删除
                var removeMarker = function(e,ee,marker){
                    map.removeOverlay(marker);
                };
                var markerMenu=new BMap.ContextMenu();
                markerMenu.addItem(new BMap.MenuItem('删除',removeMarker.bind(marker)));
                marker.addContextMenu(markerMenu);
            }
        }); 
        
        
        
    })
    //点击地图后滚动
    map.addEventListener("click", function() {
       map.enableScrollWheelZoom();//启动鼠标滚轮缩放地图
    })
   
    //返回中心点
    $('#back').click(function(){
        map.centerAndZoom(point, 14);
    })

    //图片随鼠标移动
    function DivFlying() {
        
        if (!cursorFly) {
            return;
        }
        var intX = window.event.clientX;
        var intY = window.event.clientY;
        var xScroll = Math.max(document.body.scrollLeft, document.documentElement.scrollLeft);
        var yScroll = Math.max(document.body.scrollTop, document.documentElement.scrollTop);
        cursorFly.style.left = intX + xScroll - 15 + "px";
        cursorFly.style.top = intY + yScroll -33 + "px";
    }

