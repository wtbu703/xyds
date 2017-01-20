//页面校验
$(function(){
    $.formValidator.initConfig({
        formid:"resourceForm",
        autotip:true,			//是否显示提示信息
        onerror:function(msg,obj)
        {window.top.art.dialog({content:msg,lock:true,width:'200',height:'50'}, function(){this.close();$(obj).focus();})}});

    //校验控制器名称
    $("#tableName").formValidator({
            onshow:"请输入控制器名称",
            onfocus:"控制器名称必须是英文字母！"})
        .inputValidator({                  //校验不能为空
            min:1,
            onerror:"控制器名称不能为空！"});
        /*.ajaxValidator({					// 校验不许重复
            type:"get",
            url:checkUrl,
            async:false,
            data:{
                'tableName':$("#tableName").val(),
            },
            datatype:"text", //必须是html
            success : function(data){
                if(data == "exist"){
                    return false;
                }else{
                    return true;
                }
            },
            buttons: $("#dosubmit"),  // 页面提示----"输入正确"
            onerror : "控制器名称已存在",
            onwait : "正在连接，请稍候。"});
    // 校验操作名称
    $("#tableOpreate").formValidator({
            onshow:"请输入操作名称",
            onfocus:"操作名称必须是英文字母！"})
        .inputValidator({               //校验不能为空
            min:1,
            onerror:"操作名称不能为空"});*/
});


//增加资源组项过滤
function add(){
    if($.formValidator.pageIsValid()){
        var ids = $("input[name='opreateOrders']");
        var message = "";
        var paraStr = "";
        //增加字典项
        if(ids != null && ids.length != 0 && typeof(ids.val())!= "undefined"){
            var tableOpreates = $("input[name='tableOpreate']");
            //var notes = $("input[name='note']");
            var narry = new Array();
            for(var i=0;i<tableOpreates.length;i++){
                narry[i] = tableOpreates[i].value;
            }
            narry.sort();
            for(var i=0;i<tableOpreates.length-1;i++){
                if(narry[i] == narry[i+1]){
                    window.top.art.dialog({content:'操作名重复！',lock:true,width:'250',height:'50',border: false,time:1.5},function(){});
                    message = "message";
                }
            }
            $("input[name='tableOpreate']").each(function(i,id){
                if(tableOpreates[i].value == ""){
                    window.top.art.dialog({content:'操作名不能为空!',lock:true,width:'250',height:'50',border: false,time:1.5},function(){});
                    message = "message";
                }
            });
        }
        if(message == "") {

            paraStr += "tableName="+$("#tableName").val();
            var tableOpreate = $("input[name='tableOpreate']");
            var note = $("input[name='note']");
            if(typeof(tableOpreate) != "undefined"){
                var tableOpreateStr = tableOpreate[0].value;
                var noteStr = note[0].value;
                for(var i=1;i<tableOpreate.length;i++){
                    tableOpreateStr += "@" + tableOpreate[i].value;
                    noteStr += "@" + note[i].value;
                }
                paraStr += "&tableOpreate="+tableOpreateStr;
                paraStr += "&note="+noteStr;
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
                        art.dialog.parent.location.href = listUrl;
                        window.top.$.dialog.get('resource_add').close();
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
                error:function(data){
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
}

function addrow(){
    var modelTplBody=$('#modelTplTB');
    var rowId=Math.random();
    var html = new Array();
    html.push('<tr id="'+rowId+'">');
    html.push(' <td align="left"><input name="opreateOrders" type="text" value="0" size="5" /></td>');
    html.push(' <td align="left"><input name="tableOpreate" type="text" value="" size="15" /></td>');
    html.push('	<td align="left"><input name="note" type="text" value="" size="25" /></td>');
    html.push('	<td align="left"><a href="javascript:delrow(\''+rowId+'\')">[删除]</a></td>');
    html.push('</tr>');
    modelTplBody.append(html.join(''));
    $(":text").addClass('input-text');
}

//删除行
function delrow(rowId){
    var row=document.getElementById(rowId);
    var index=row.rowIndex;
    var objTable=document.getElementById('modelTplTable');
    objTable.deleteRow(index);
}

