//页面校验
$(function(){
	$.formValidator.initConfig({
		formid:"categoryForm",
		autotip:true,			//是否显示提示信息
		onerror:function(msg,obj){
            window.top.art.dialog({
                content:msg,
                lock:true,
                width:'200',
                height:'50'
            }, function(){
                this.close();
                $(obj).focus();
            })
        }
    });
	//校验模型标识
	$("#categoryCode").formValidator({
		onshow:"请输入大类标识",
		onfocus:"标识必须是英文字母！"
    }).inputValidator({                  //校验不能为空
        min:1,
        onerror:"标识不能为空！"
    }).ajaxValidator({					// 校验不许重复
        type:"get",
        url:checkCodeUrl,
        async:false,
        data:{
            'categoryCode':$("#categoryCode").val()
        },
        datatype:"text", //必须是html
        success : function(data){
            return data != "exist";
        },
        buttons: $("#dosubmit"),  // 页面提示----"输入正确"
        onerror : "该标识已存在",
        onwait : "正在连接，请稍候。"
    });
	// 校验模型名称					
	$("#categoryName").formValidator({
		onshow:"请输入大类名称",
		onfocus:"大类名称必须是汉字"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"大类名称不能为空"
    }).regexValidator({              //校验必须是汉字
        regexp:"chinese",
        datatype:"enum",
        param:'i',
        onerror:"只能是汉字"
    })
});


//增加过滤
function add(){
	if($.formValidator.pageIsValid()){
		var paraStr = "";
        var categoryFullOrders = $("input[name='categoryFullOrders']");
        var picUrls = $("input[name='attachUrls']");
		//增加子项


			paraStr += "picCode="+$("#categoryCode").val();
			paraStr += "&picName="+$("#categoryName").val();
			paraStr += "&intro="+$("#intro").val();

			if(typeof(picUrls) != "undefined"){
                var categoryFullOrdersStr = categoryFullOrders[0].value;
				var picUrlsStr = picUrls[0].value;
				for(var i=1;i<categoryFullOrders.length;i++){
                    categoryFullOrdersStr += "-" + categoryFullOrders[i].value;
                    picUrlsStr += ";" + picUrls[i].value;

				}

				paraStr += "&categoryFullOrders="+categoryFullOrdersStr;
				paraStr += "&picUrls="+picUrlsStr;
			}
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
						window.top.$.dialog.get('category_add').close();
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

function addRow(){
	var modelTplBody=$('#modelTplTB');
	var rowId=Math.random();
	var html = [];
	html.push('<tr id="'+rowId+'">');
	html.push(' <td align="left"><input name="categoryFullOrders" type="text" value="0" size="5" /></td>');
	html.push('	<td align="left"><input type="text" style="display:none;" name="attachUrls" id="attachUrls" class="input-text"/>');
    html.push('	<input type="text" style="display:none;" name="attachNames" id="attachNames" class="input-text"/>');
    html.push('	<iframe frameborder="0" width="100%" height="20px" scrolling="no" src="'+uploadUrl+'"></iframe></td>');
	html.push('	<td align="left"><a href="javascript:deleteRow(\''+rowId+'\')">[删除]</a></td>');
	html.push('</tr>');
	modelTplBody.append(html.join(''));
	$(":text").addClass('input-text');
}

//删除行
function deleteRow(rowId){
    var row=document.getElementById(rowId);
    var index=row.rowIndex;
    var objTable=document.getElementById('modelTplTable');
    objTable.deleteRow(index);
}

