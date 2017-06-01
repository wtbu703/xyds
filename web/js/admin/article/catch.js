// 加载字典信息
$(document).ready(function(){
    generateWeb();
})
//生成状态下拉框
function generateWeb(){
    var dictArray = new Array();
    dictArray.push("<option value=''><--请选择网站--></option>");
    $.ajax({
        url:listdictUrl,
        type:"post",
        dataType:"json",
        data:"dictCode=DICT_WEB",
        async:false,
        success:function(data){
            $.each(data,function(i,n){
                dictArray.push("<option value='"+ n.dictItemName +"'>"+ n.dictItemName +"</option>");
            });
            $('#web').html(dictArray.join(''));
        },
        error:function (data) {
            window.top.art.dialog({content:'加载字典组出错！',lock:true,width:'250',height:'50',border: false,time:1.5},function(){});
        }
    });

}


function search(){
    if(str_is_null($('#web').val()) ) {
        window.top.art.dialog({
            content: '网站不能为空！',
            lock: true,
            width: 250,
            height: 100,
            border: false,
            time: 2
        });
        return ;
    }
    var paraStr = "&web="+$('#web').val();
    $('#iframeId').attr('src',listallUrl+paraStr);
}
