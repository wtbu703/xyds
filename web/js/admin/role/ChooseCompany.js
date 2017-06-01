$(document).ready(function(){
    generateRole();
});

function generateRole(){
    var dictArray = [];
    dictArray.push("<option value=''><--请选择企业--></option>");
    $.ajax({
        url:listCompanyUrl,
        type:"post",
        dataType:"json",
        async:false,
        success:function(data){
            $.each(data,function(i,n){
                dictArray.push("<option value='"+ n.id +"'>"+ n.name +"</option>");
            });
            $('#company').html(dictArray.join(''));
        },
        error:function (data) {
            window.top.art.dialog({content:'加载企业出错！',lock:true,width:'250',height:'50',border: false,time:1.5},function(){});
        }
    });

}

function saveCompany(){
    var paraStr = "";
    paraStr +="adminId="+$("#adminId").val();
    paraStr +="&companyId="+$("#company").val();
    $.ajax({
        url: saveCompanyUrl,
        type: "post",
        dataType: "text",
        data:paraStr ,
        async: "false",
        success: function (data) {
            window.top.art.dialog({
                content: '保存成功！',
                lock: true,
                width: 250,
                height: 80,
                border: false,
                time: 2
            }, function () {
            });
            window.top.$.dialog.get('choose_company').close();
        },
        error:function(data){
            window.top.art.dialog({
                content: '保存失败！',
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