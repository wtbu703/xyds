<?php
$this->title = "修改培训";
?>
<script>
    var updateUrl = "<?=yii::$app->urlManager->createUrl('ectrain-info/update-one')?>";
</script>
<script language="javascript" type="text/javascript" src="js/admin/ectrain-info/edit.js" charset="utf-8"></script>

<div class="pad-lr-10">
<form name="myform" action="" method="post" id="myform" target="center_frame">
    <div class="pad-10">
        <div class="col-tab">
            <ul class="tabBut cu-li">
                <li id="tab_setting_1" class="on" onclick="">修改培训</li>
            </ul>
            <div id="div_setting_1" class="contentList pad-10">
                <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                    <table width="90%" cellspacing="0" class="table_form contentWrap">
                        <tbody>
                        <tr>
                            <th width="100px">培训ID：</th>
                            <td><input type="text" style="width:250px;" name="trainId" id="trainId" value="<?=$ectrainInfo->trainId?>" class="input-text"/></td>
                            <input type="hidden" id="id" value="<?=$ectrainInfo->id?>" />
                        </tr>
                        <tr>
                            <th >中央财政资金支持总金额：</th>
                            <td><input type="text" style="width:250px;" name="centralSupport" id="centralSupport" value="<?=$ectrainInfo->centralSupport?>" onkeyup="this.value=this.value.replace(/[^0-9-.-]+/,'');" class="input-text"/>万元</td>
                        </tr>
                        <tr>
                            <th>中央财政资金已拨付金额：</th>
                            <td><input type="text" style="width:250px;" name="centralPaid" id="centralPaid" value="<?=$ectrainInfo->centralPaid?>" onkeyup="this.value=this.value.replace(/[^0-9-.-]+/,'');" class="input-text"/>万元</td>
                        </tr>
                        <tr>
                            <th>地方财政配套资金总金额：</th>
                            <td><input type="text" style="width:250px;" name="localSupport" id="localSupport" value="<?=$ectrainInfo->localSupport?>" onkeyup="this.value=this.value.replace(/[^0-9-.-]+/,'');" class="input-text"/>万元</td>
                        </tr>
                        <tr>
                            <th>企业投入资金总金额：</th>
                            <td><input type="text" style="width:250px;" name="companyPaid" id="companyPaid" value="<?=$ectrainInfo->companyPaid?>" onkeyup="this.value=this.value.replace(/[^0-9-.-]+/,'');" class="input-text"/>万元</td>
                        </tr>
                        <tr>
                            <th>企业网商总数：</th>
                            <td><input type="text" style="width:250px;" name="companyNum" id="companyNum" value="<?=$ectrainInfo->companyNum?>" onkeyup="this.value=this.value.replace(/[^0-9-.-]+/,'');" class="input-text"/>个</td>
                        </tr>
                        <tr>
                            <th>当月新孵化企业网商：</th>
                            <td><input type="text" style="width:250px;" name="newCompanyThisM" id="newCompanyThisM" value="<?=$ectrainInfo->newCompanyThisM?>" onkeyup="this.value=this.value.replace(/[^0-9-.-]+/,'');" class="input-text"/>个</td>
                        </tr>
                        <tr>
                            <th>个人网商总数：</th>
                            <td><input type="text" style="width:250px;" name="singleNum" id="singleNum"  value="<?=$ectrainInfo->singleNum?>" onkeyup="this.value=this.value.replace(/[^0-9-.-]+/,'');" class="input-text"/>个</td>
                        </tr>
                        <tr>
                            <th>当月新孵化个人网商：</th>
                            <td><input type="text" style="width:250px;" name="newSingleThisM" id="newSingleThisM" value="<?=$ectrainInfo->newSingleThisM?>" onkeyup="this.value=this.value.replace(/[^0-9-.-]+/,'');" class="input-text"/>个</td>
                        </tr>
                        <tr>
                            <th>项目承办单位：</th>
                            <td><input type="text" style="width:250px;" name="organizer" id="organizer" value="<?=$ectrainInfo->organizer?>" class="input-text"/></td>
                        </tr>
                        <tr>
                            <th>承办单位负责人：</th>
                            <td><input type="text" style="width:250px;" name="chargeName" id="chargeName" value="<?=$ectrainInfo->chargeName?>" class="input-text"/></td>
                        </tr>
                        <tr>
                            <th>负责人联系电话：</th>
                            <td><input type="text" style="width:250px;" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');" name="chargeMobile" id="chargeMobile" value="<?=$ectrainInfo->chargeMobile?>" class="input-text"/></td>
                        </tr>
                        <tr>
                            <th>中央财政资金支持此项目的政府决策单位：</th>
                            <td><input type="text" style="width:250px;" name="centralDecisionUnit" id="centralDecisionUnit" value="<?=$ectrainInfo->centralSupport?>" class="input-text"/></td>
                        </tr>
                        <tr>
                            <th>决策文件：</th>
                            <td>
                                <input type="text" style="display:none;" name="attachUrls" id="attachUrls" class="input-text"/>
                                <input type="text" style="display:none;" name="attachNames" id="attachNames" class="input-text"/>
                                <iframe frameborder=0 width="100%" height=20px scrolling=no src="<?=yii::$app->urlManager->createUrl('ectrain-info/upload')?>"></iframe>
                            </td>
                        </tr>
                        <tr>
                            <th>信息公开网址链接：</th>
                            <td><input type="text" style="width:250px;" name="publicInfoUrl" id="publicInfoUrl" value="<?=$ectrainInfo->publicInfoUrl?>" class="input-text"/></td>
                        </tr>
                        <tr>
                            <th>培训人员签到表：</th>
                            <td>
                                <input type="text" style="display:none;" name="signSheetUrl" id="signSheetUrl" class="input-text"/>
                                <input type="text" style="display:none;" name="attachNames" id="attachNames" class="input-text"/>
                                <iframe frameborder=0 width="100%" height=20px scrolling=no src="<?=yii::$app->urlManager->createUrl('ectrain-info/uploads')?>"></iframe>
                            </td>
                        </tr>
                        <tr>
                            <th>培训时间：</th>
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
                        </tbody>
                    </table>
                </div>
                <div class="bk10"></div>
                <div class="rightbtn">
                    <input type="button" class="buttonconfirm" id="dosubmits" name="dosubmits" value="保存" onclick="edit()"/>
                    &nbsp;&nbsp;<input type="button" class="buttondel" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('info_update').close();"/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div>
        </div>
    </div>
</form>
</div>