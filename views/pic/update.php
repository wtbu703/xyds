<script type="text/javascript">
    var state = "<?=$category->state?>";
    var listdictUrl = '<?=Yii::$app->urlManager->createUrl('dict/findall')?>';
    var updateUrl = '<?=Yii::$app->urlManager->createUrl('pic/update-one')?>';
    var deleteOneUrl = '<?=Yii::$app->urlManager->createUrl('pic/delete-one-item')?>';
    var uploadUrl = '<?=yii::$app->urlManager->createUrl('third-party-service/upload')?>';
</script>
<script language="javascript" type="text/javascript" src="js/admin/pic/update.js" charset="utf-8"></script>
<div class="pad-lr-10">
    <form action="<?=Yii::$app->urlManager->createUrl('pic/update-one')?>" id="categoryForm" name="categoryForm" method="post" target="iframeId">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th width="100">图片大类标识</th>
                        <td>
                            <?=$category->picCode?><input type="hidden" id="categoryCode" value="<?=$category->picCode?>"/>
                        </td>
                    </tr>
                    <tr>
                        <th width="100">图片大类名称</th>
                        <td>
	                        <input type="text" style="width:250px;height: 30px;" name="categoryName" id="categoryName" value="<?=$category->picName?>" class="input-text"/></td>
                    </tr>
                    <tr>
                        <th width="100">简介</th>
                        <td><textarea style="width:350px;height:80px;" id="intro" name="intro"><?=$category->intro?></textarea></td>
                    </tr>
                    <tr>
                        <th>是否可用</th>
                        <td>
                            <select id="state" name="state" style="width:100px"></select>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="bk10"></div>
        </div>
        <!--列表-->
        <div class="table-list">
            <table id="modelTplTable" width="100%" cellspacing="0">
                <thead>
                <tr>
	                <th align="left">排序</th>
	                <th align="left">原图</th>
	                <th align="left">上传图片</th>
                    <th align="left">操作</th>
                </tr>
                </thead>
                <tbody id="modelTplTB">
                    <?php if(!is_null($categoryFulls)){?>
                        <?php foreach ($categoryFulls as $index => $categoryFull){?>
                            <tr id="<?=$index?>">
                                <td align="left">
                                    <input name="categoryFullOrders" class="input-text" type="text" value="<?=$categoryFull->orderBy?>" size="5" />
                                    <input name="dictItemIds" value="<?=$categoryFull->id?>" type="hidden"/>
                                </td>
	                            <td align="left">
		                            <img width="200" height="200" src="<?=$categoryFull->picUrl?>"/>
	                            </td>
                                <td align="left">
	                                <input type="text" style="display:none;" name="attachUrls" id="attachUrls" class="input-text" value="<?=$categoryFull->picUrl?>"/>
	                                <input type="text" style="display:none;" name="attachNames" id="attachNames" class="input-text"/>
	                                <iframe frameborder="0" width="100%" height="20px" scrolling="no" src="<?=Yii::$app->urlManager->createUrl('third-party-service/upload')?>"></iframe>
                                </td>
                                <td align="left"><a href="javascript:deleteRow('<?=$index?>','<?=$categoryFull->id?>')">[删除]</a></td>
                            </tr>
                        <?}?>
                    <?}?>
                </tbody>
            </table>
            <div class="btn">
                <input type="button" class="buttonadd" name="dosubmit" value="增加" onclick="addRow()"/>
                <input type="button" class="buttonsave" name="dosubmit" value="保存" onclick="update()"/>
                <input type="button" class="buttonclose" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('category_update').close();"/>
            </div>
        </div>
    </form>
</div>