<?php
$this->title = '添加企业';
?>
<script type="text/javascript">
    var listallUrl = "<?=yii::$app->urlManager->createUrl('company/find-by-attri')?>";
    var insertUrl = "<?=yii::$app->urlManager->createUrl('company/add-one')?>";

    function pic(){
        var a;
        var timeText = $('.pic_text');
        a = document.myform.picUrl.value;
        a = "<img src='"+a+"'  width='60%'>";
        timeText.html(a);
    }
    //正则表达式验证公司网址
    function IsUrl(str){
        if(str != '') {
            var regUrl = /^([hH][tT]{2}[pP]:\/\/|[hH][tT]{2}[pP][sS]:\/\/)(([A-Za-z0-9-~]+)\.)+([A-Za-z0-9-~\/])+$/;
            var result = str.match(regUrl);
            if (result != null) {
                //alert("网址输入正确 ");
            }
            else {
               alert("网址输入不正确");
            }
        }
    }
</script>
<script type="text/javascript" src="js/admin/company/add.js"></script>

<div class="pad-lr-10">
    <form name="myform" action="" method="post" id="myform" target="iframeId">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th width="100px">企业类别：</th>
                        <td><select id="category"  style='width:250px;height:25px; ' class="input-text"/></select></td>
                    </tr>
                    <tr>
                        <th >企业名称：</th>
                        <td><input type="text" style="width:250px;" name="name" id="name" onkeyup="value=value.replace(/[^a-\z\A-\Z\u4E00-\u9FA5]/g,'')" maxlength="16" class="input-text"/></td>
                    </tr>
                    <tr>
                        <th>联系电话：</th>
                        <td><input type="text" style="width:250px;" name="tel" id="tel" onkeyup="this.value=this.value.replace(/[^0-9-.-]+/,'');" class="input-text"/></td>
                    </tr>
                    <tr>
                        <th>企业地址：</th>
                        <td><input type="text" style="width:250px;" name="address" id="address"  class="input-text"/></td>
                    </tr>
                    <tr>
                        <th>公司网址：</th>
                        <td><input type="text" style="width:250px;" name="webSite"  id="webSite"  onmouseout= "IsUrl(document.myform.webSite.value)" class="input-text"/></td>
                    </tr>
                    <tr>
                        <th>内容来源：</th>
                        <td><input type="text" style="width:250px;" name="sources" id="sources"  class="input-text"/></td>
                    </tr>
                    <tr>
                        <th>企业法人：</th>
                        <td><input type="text" style="width:250px;"  name="corporate" id="corporate"  class="input-text"/></td>
                    </tr>
                    <tr>
                        <th>企业简介：</th>
                        <td><textarea style="width:450px;height:100px;" name="introduction" id="introduction" ></textarea></td>
                    </tr>
                   <tr onmouseout="pic()">
                        <th>企业图片：</th>
                        <td>
                            <input type="text" style="display:none;" name="picUrl" id="picUrl" value="" class="input-text"/>
                            <iframe frameborder=0 width="100%" height=40px scrolling=no src="<?=yii::$app->urlManager->createUrl('company/upload')?>"></iframe>
                        </td>
                    </tr>
                    <tr>
                        <th>图片预览：</th>
                        <td class="pic_text"></td>
                    </tr>
                </table>
            </div>
            <div class="bk10"></div>
        </div>
    </form>
    <div class="table-list">
        <div class="rightbtn">
            <input type="button" class="buttonsave" value="增加" name="dosubmit" onclick="add()" />
            <input type="button" class="buttonclose" value="关闭" name="dosubmit"  onclick="window.top.$.dialog.get('company_add').close();"/>
        </div>
    </div>
</div>
</br></br></br>
<script type="text/javascript">
    var contentEditor=genEditor('','introduction','');
</script>

