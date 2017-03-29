var delId = [];
// 获取字典
$(function(){
	$.ajax ({
		type:"post",
		url:listdictUrl,
		dataType:"json",
		data:"dictCode=DICT_STATE",
		async:true,
		error: function () {
			window.top.art.dialog({content:'获取字典类型出错！',lock:true,width:'250',height:'50',border: false,time:1.5},function(){});
		},
		success: function(data) {
			var selectarray =  [];
			$.each(data,function(i,n){
				if(n.dictItemCode == state){
					selectarray.push("<option value='"+ n.dictItemCode +"' selected='selected'>"+ n.dictItemName +"</option>");
				}else{
					selectarray.push("<option value='"+ n.dictItemCode +"'>"+ n.dictItemName +"</option>");
				}
			});
			$('#state').html(selectarray.join(''));
		}
	});

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

// 修改
function update(){
	if($.formValidator.pageIsValid()){

        var paraStr = "";
        var categoryFullOrders = $("input[name='categoryFullOrders']");
        var picUrls = $("input[name='attachUrls']");

        var dictItemIds = $("input[name='dictItemIds']");
		//增加字典项
        for(var i=0;i<delId.length;i++){
            if(delId[i] != '1'){
                deletePicFull(delId[i]);
            }
        }
        paraStr += "categoryCode="+$("#categoryCode").val();
        paraStr += "&picName="+$("#categoryName").val();
        paraStr += "&intro="+$("#intro").val();
        paraStr += "&state="+$("#state").val();
            if(typeof(picUrls) != "undefined"){
                var categoryFullOrdersStr = categoryFullOrders[0].value;
                var picUrlsStr = picUrls[0].value;

                var dictItemIdsStr = dictItemIds[0].value;
                for(var a=1;a<categoryFullOrders.length;a++){
                    categoryFullOrdersStr += "-" + categoryFullOrders[a].value;
                    picUrlsStr += ";" + picUrls[a].value;
                    dictItemIdsStr += "-" + dictItemIds[a].value;

                }
                alert(picUrlsStr);
                paraStr += "&orders="+categoryFullOrdersStr;
                paraStr += "&picUrls="+picUrlsStr;
                paraStr += "&ids="+dictItemIdsStr;
            }

			$.ajax({
				url: updateUrl,
				type: "post",
				dataType: "text",
				data:paraStr ,
				async: "false",
				success: function (data) {
					if(data == "success"){
						window.top.art.dialog({
							content: '修改成功！',
							lock: true,
							width: 250,
							height: 80,
							border: false,
							time: 2
						}, function () {
						});
						art.dialog.parent.$('#pageForm').submit();
						window.top.$.dialog.get('category_update').close();
					}else{
						window.top.art.dialog({
							content: '修改失败！',
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
						content: '修改失败！',
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
    html.push('	<td align="right"><a href="javascript:deleteRow(\''+rowId+'\')">[删除]</a></td>');
    html.push('</tr>');
	modelTplBody.append(html.join(''));
	$(":text").addClass('input-text');
}

//删除行
function deleteRow(rowId,id){
	delId.push(id);//将ID放入数组
    var row=document.getElementById(rowId);
    var index=row.rowIndex;
    var objTable=document.getElementById('modelTplTable');
	objTable.deleteRow(index);
}

//删除行中对应的图片项
function deletePicFull(id){
	var paraStr = '&id='+id;
	$.ajax({
		url: deleteOneUrl,
		type: "post",
		dataType: "text",
		data:paraStr ,
		async: "false",
		success: function (data) {

		}
	});
}