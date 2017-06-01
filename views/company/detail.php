<?php
$this->title = '企业详情';
?>
<script type="text/javascript">
    var editUrl = "<?=yii::$app->urlManager->createUrl('company/update')?>";
</script>
<script language="javascript" type="text/javascript" src="js/admin/company/detail.js" charset="utf-8"></script>

<div class="pad-lr-10">
    <form id="myform" action="" method="post">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th width="100px" align="right">企业类别</th>
                        <td id="category"><?=$company->category?></td>
                    </tr>
                    <tr>
                        <th width="100" align="right">企业名称</th>
                        <td id="name"><?=$company->name?></td>
                    </tr>
                    <tr>
                        <th width="100" align="right">企业法人</th>
                        <td id="corporate"><?=$company->corporate?></td>
                    </tr>
                    <tr>
                        <th width="100" align="right">企业地址</th>
                        <td id="address"><?=$company->address?></td>
                    </tr>
                    <tr>
                        <th width="100" align="right">企业网站</th>
                        <td id="address"><?=$company->webSite?></td>
                    </tr>
                    <tr>
                        <th width="100" align="right">内容来源</th>
                        <td id="address"><?=$company->sources?></td>
                    </tr>
                    <tr>
                        <th width="100" align="right">发布时间</th>
                        <td id="address"><?=$company->datetime?></td>
                    </tr>
                    <tr>
                        <th width="100" align="right">联系电话</th>
                        <td id="tel"><?=$company->tel?></td>
                    </tr>
                    <tr>
                        <th width="100" align="right">企业简介</th>
                        <td id="introduction"><?=$company->introduction?></td>
                    </tr>
                    <tr>
                        <th width="100" align="right">企业图片</th>
                        <td id="logoUrl"><img src="<?=$company->logoUrl?>" width="40%"></td>
                    </tr>
                </table>
            </div>
            <div class="bk10"></div>

            <div class="table-list">

                <div class="rightbtn">
                    <?php if($type==1){?>
                        <input type="button" class="buttonclose" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('company_detail').close();" />
                    <?}else{?>
                        <input type="button" class="buttonclose" style="width: 30px;" value="修改" onclick="openedit('<?=$company->id?>','<?=$company->name?>')" />
                    <?}?>
                </div>
            </div>
    </form>
</div>
