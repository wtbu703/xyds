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

</script>

<script type="text/javascript" src="js/admin/company/add.js"></script>

<div class="pad-lr-10">
    <form name="myform" action="" method="post" id="myform" target="iframeId">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th width="130px" align="right"><sub class="redstar">*</sub>企业类别：</th>
                        <td><select id="category"  style='width:250px;height:25px; ' class="input-text"/></select></td>
                        <td class="one"><div id="categoryTip"></div></td>
                    </tr>
                    <tr>
                        <th align="right"><sub class="redstar">*</sub>企业名称:</th>
                        <td class="one"><input type="text" id="name" class="inputxt"/></td>
                        <td class="one"><div id="nameTip"></div></td>
                    </tr>
                    <tr>
                        <th align="right"><sub class="redstar">*</sub>联系电话:</th>
                        <td><input type="text" id="tel" class="inputxt" style="width:270px;" /></td>
                        <td class="one"><div id="telTip"></div></td>
                    </tr>
                    <tr>
                        <th align="right"><sub class="redstar">*</sub>企业地址:</th>
                        <td><input type="text" id="address" class="inputxt" style="width:270px;"  /></td>
                        <td class="one"><div id="addressTip"></div></td>
                    </tr>
                    <tr>
                        <th align="right"><sub class="redstar">*</sub>网址:</th>
                        <td><input type="text" class="inputxt" style="width:250px;" id="webSite"/></td>
                        <td class="one"><div id="webSiteTip"></div></td>
                    </tr>
                    <tr>
                        <th align="right"><sub class="redstar">*</sub>内容来源:</th>
                        <td><input type="text" style="width:250px;" id="sources"  class="inputxt" /></td>
                        <td class="one"><div id="sourcesTip"></div></td>
                    </tr>
                    <tr>
                        <th  align="right"><sub class="redstar">*</sub>企业法人:</th>
                        <td><input type="text" id="corporate" class="inputxt"  /></td>
                        <td class="one"><div id="corporateTip">请填写法人昵称</div></td>
                    </tr>
	                <tr>
		                <th align="right"><sub class="redstar">*</sub>企业管理员用户名：</th>
		                <td><input type="text" style="width:250px;"  name="companyUsername" id="companyUsername" class="inputxt"/></td>
                        <td class="one"><div id="companyUsernameTip"></div></td>
	                </tr>
	                <tr>
		                <th align="right"><sub class="redstar">*</sub>企业管理员密码：</th>
		                <td><input type="password" style="width:250px;"  name="companyPassword" id="companyPassword"  class="inputxt"/></td>
                        <td class="one"><div id="companyPasswordTip"></div></td>
	                </tr>
                    <tr>
                        <th align="right">企业简介：</th>
                        <td colspan="2"><textarea style="width:450px;height:100px;" name="introduction" id="introduction" ></textarea></td>
                    </tr>
                   <tr onmouseout="pic()">
                        <th align="right">企业图片：</th>
                        <td colspan="2">
                            <input type="text" style="display:none;" name="picUrl" id="picUrl" value="" class="input-text"/>
                            <iframe frameborder=0 width="100%" height=40px scrolling=no src="<?=yii::$app->urlManager->createUrl('company/upload')?>"></iframe>
                        </td>
                    </tr>
                    <tr>
                        <th align="right">图片预览：</th>
                        <td class="pic_text"></td>
                        <td></td>
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

