<?php
$this->title = '添加培训详情';
?>

<script type="text/javascript">
    var listallUrl = "<?=yii::$app->urlManager->createUrl('ectrain-info/find-by-attri')?>";
    var insertUrl = "<?=yii::$app->urlManager->createUrl('ectrain-info/add-one')?>";
</script>
<script type="text/javascript" src="js/admin/ectrain-info/add.js"></script>


<div class="pad-lr-10">
    <form name="myform" action="" method="post" id="myform" target="iframeId">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th width="200px" align="right"><sub class="redstar">*</sub>培训ID：</th>
                        <td><input type="text" style="width:250px;" name="trainId" id="trainId" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');"  class="input-text"/></td>
                    </tr>
                    <tr>
                        <th align="right"><sub class="redstar">*</sub>中央财政资金支持总金额：</th>
                        <td><input type="text" style="width:250px;" name="centralSupport" id="centralSupport" onkeyup="this.value=this.value.replace(/[^0-9-.-]+/,'');" class="input-text"/>万元</td>
                    </tr>
                    <tr>
                        <th align="right"><sub class="redstar">*</sub>中央财政资金已拨付金额：</th>
                        <td><input type="text" style="width:250px;" name="centralPaid" id="centralPaid" onkeyup="this.value=this.value.replace(/[^0-9-.-]+/,'');" class="input-text"/>万元</td>
                    </tr>
                    <tr>
                        <th align="right"><sub class="redstar">*</sub>地方财政配套资金总金额：</th>
                        <td><input type="text" style="width:250px;" name="localSupport" id="localSupport" onkeyup="this.value=this.value.replace(/[^0-9-.-]+/,'');" class="input-text"/>万元</td>
                    </tr>
                    <tr>
                        <th align="right"><sub class="redstar">*</sub>企业投入资金总金额：</th>
                        <td><input type="text" style="width:250px;" name="companyPaid" id="companyPaid" onkeyup="this.value=this.value.replace(/[^0-9-.-]+/,'');" class="input-text"/>万元</td>
                    </tr>
                    <tr>
                        <th align="right"><sub class="redstar">*</sub>企业网商总数：</th>
                        <td><input type="text" style="width:250px;" name="companyNum" id="companyNum" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');" class="input-text"/>个</td>
                    </tr>
                    <tr>
                        <th align="right"><sub class="redstar">*</sub>当月新孵化企业网商：</th>
                        <td><input type="text" style="width:250px;" name="newCompanyThisM" id="newCompanyThisM" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');" class="input-text"/>个</td>
                    </tr>
                    <tr>
                        <th align="right"><sub class="redstar">*</sub>个人网商总数：</th>
                        <td><input type="text" style="width:250px;" name="singleNum" id="singleNum" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');" class="input-text"/>个</td>
                    </tr>
                    <tr>
                        <th align="right"><sub class="redstar">*</sub>当月新孵化个人网商：</th>
                        <td><input type="text" style="width:250px;" name="newSingleThisM" id="newSingleThisM" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');" class="input-text"/>个</td>
                    </tr>
                    <tr>
                        <th align="right"><sub class="redstar">*</sub>项目承办单位：</th>
                        <td><input type="text" style="width:250px;" name="organizer" id="organizer"  class="input-text"/></td>
                    </tr>
                    <tr>
                        <th align="right"><sub class="redstar">*</sub>承办单位负责人：</th>
                        <td><input type="text" style="width:250px;" name="chargeName" id="chargeName"  class="input-text"/></td>
                    </tr>
                    <tr>
                        <th align="right"><sub class="redstar">*</sub>负责人联系电话：</th>
                        <td><input type="text" style="width:250px;" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');" name="chargeMobile" id="chargeMobile"  class="input-text"/></td>
                    </tr>
                    <tr>
                        <th align="right"><sub class="redstar">*</sub>中央财政资金支持此项目的政府决策单位：</th>
                        <td><input type="text" style="width:250px;" name="centralDecisionUnit" id="centralDecisionUnit"  class="input-text"/></td>
                    </tr>
                    <tr>
                        <th align="right">决策文件：</th>
                        <td>
                            <input type="text" style="display:none;" name="attachUrls" id="attachUrls" class="input-text"/>
                            <input type="text" style="display:none;" name="attachNames" id="attachNames" class="input-text"/>
                            <iframe frameborder=0 width="100%" height=20px scrolling=no src="<?=yii::$app->urlManager->createUrl('ectrain-info/upload')?>"></iframe>
                        </td>
                    </tr>
                    <tr>
                        <th align="right"><sub class="redstar">*</sub>信息公开网址链接：</th>
                        <td><input type="text" style="width:250px;" name="publicInfoUrl" id="publicInfoUrl"  class="input-text"/></td>
                    </tr>
                    <tr>
                        <th align="right">培训人员签到表：</th>
                        <td>
                            <input type="text" style="display:none;" name="signSheetUrl" id="signSheetUrl" class="input-text"/>
                            <input type="text" style="display:none;" name="signSheetName" id="signSheetName" class="input-text"/>
                            <iframe frameborder=0 width="100%" height=20px scrolling=no src="<?=yii::$app->urlManager->createUrl('ectrain-info/uploads')?>"></iframe>
                        </td>
                    </tr>
                    <tr>
                        <th align="right">培训时间：</th>
                        <td><input id="published" name="published" type="text" value="" class="date">
                            <script type="text/javascript">
                                Calendar.setup({
                                    weekNumbers: true,
                                    inputField : "published",
                                    trigger    : "published",
                                    dateFormat: "%Y-%m-%d %k:%M:%S",
                                    showTime: true,
                                    minuteStep: 1,
                                    onSelect   : function() {this.hide();}
                                });
                            </script>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="bk10"></div>
        </div>
    </form>
    <div class="table-list">
        <div class="rightbtn">
            <input type="button" class="buttonsave" value="增加" name="dosubmit" onclick="add()" />
            <input type="button" class="buttonclose" value="关闭" name="dosubmit"  onclick="window.top.$.dialog.get('info_add').close();"/>
        </div>
    </div>
</div>


