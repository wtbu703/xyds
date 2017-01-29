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
        onshow:"请输入商品大类名称",
        onfocus:"商品大类名称必须是汉字"
    }).inputValidator({               //校验不能为空
        min:1,
        onerror:"商品大类名称不能为空"
    }).regexValidator({              //校验必须是汉字
        regexp:"chinese",
        datatype:"enum",
        param:'i',
        onerror:"只能是汉字"
    })
});

// 修改字典
function update(){
	if($.formValidator.pageIsValid()){
        var ids = $("input[name='categoryFullOrders']");
        var message = "";
        var paraStr = "";
        var categoryFullOrders = $("input[name='categoryFullOrders']");
        var categoryFullNames = $("input[name='categoryFullNames']");
        var buyCodes = $("input[name='buyCodes']");
        var sellCodes = $("input[name='sellCodes']");
        var dictItemIds = $("input[name='dictItemIds']");
		//增加字典项
        if(ids != null && ids.length != 0){

            var narry = [];
            for(var i=0;i<categoryFullNames.length;i++){
                narry[i] = categoryFullNames[i].value;
            }
            narry.sort();
            for(var i=0;i<categoryFullNames.length-1;i++){
                if(narry[i] == narry[i+1]){
                    window.top.art.dialog({content:'具体类别名称重复！',lock:true,width:'250',height:'50',border: false,time:1.5},function(){});
                    message = "message";
                }
            }
            $("input[name='categoryFullNames']").each(function(i,id){
                if(categoryFullNames[i].value == ""){
                    window.top.art.dialog({content:'具体类别名称不能为空!',lock:true,width:'250',height:'50',border: false,time:1.5},function(){});
                    message = "message";
                }
            });
        }
		if(message == "") {
			for(var i=0;i<delId.length;i++){
				if(delId[i] != '1'){
					deleteCategoryFull(delId[i]);
				}
			}
			paraStr += "categoryCode="+$("#categoryCode").val();
			paraStr += "&categoryName="+$("#categoryName").val();
			paraStr += "&intro="+$("#intro").val();
			paraStr += "&state="+$("#state").val();


            if(typeof(categoryFullNames) != "undefined"){
                var categoryFullOrdersStr = categoryFullOrders[0].value;
                var categoryFullNamesStr = categoryFullNames[0].value;
                var buyCodeStr = buyCodes[0].value;
                var sellCodeStr = sellCodes[0].value;
                var dictItemIdsStr = dictItemIds[0].value;
                for(var i=1;i<categoryFullNames.length;i++){
                    categoryFullOrdersStr += "-" + categoryFullOrders[i].value;
                    categoryFullNamesStr += "-" + categoryFullNames[i].value;
                    buyCodeStr += "-" + buyCodes[i].value;
                    sellCodeStr += "-" + sellCodes[i].value;
                    dictItemIdsStr += "-" + dictItemIds[i].value;

                }

                paraStr += "&categoryFullOrders="+categoryFullOrdersStr;
                paraStr += "&categoryFullNames="+categoryFullNamesStr;
                paraStr += "&buyCodes="+buyCodeStr;
                paraStr += "&sellCodes="+sellCodeStr;
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
}

function addRow(){
	var modelTplBody=$('#modelTplTB');
	var rowId=Math.random();
	var html = [];
	html.push('<tr id="'+rowId+'">');
	html.push(' <td align="left"><input name="categoryFullOrders" type="text" value="0" size="5" /><input name="dictItemIds" value="1" type="hidden"/></td>');
    html.push('	<td align="left"><input name="categoryFullNames" type="text" value="" size="25" /></td>');
    html.push(' <td align="left"><input name="buyCodes" type="text" value="" size="5" /></td>');
    html.push(' <td align="left"><input name="sellCodes" type="text" value="" size="5" /></td>');
    html.push('	<td align="left"><a href="javascript:deleteRow(\''+rowId+'\')">[删除]</a></td>');
	html.push('</tr>');
	modelTplBody.append(html.join(''));
	$(":text").addClass('input-text');
}

//删除行
function deleteRow(rowId,id){
	delId.push(id);
    var row=document.getElementById(rowId);
    var index=row.rowIndex;
    var objTable=document.getElementById('modelTplTable');
	objTable.deleteRow(index);
}

//删除行中对应的字典项
function deleteCategoryFull(id){
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