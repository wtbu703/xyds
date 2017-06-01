<script type="text/javascript">
    var state = "<?=$category->state?>";
    var listdictUrl = '<?=Yii::$app->urlManager->createUrl('dict/findall')?>';
    var updateUrl = '<?=Yii::$app->urlManager->createUrl('category/update-one')?>';
    var deleteOneUrl = '<?=Yii::$app->urlManager->createUrl('category/delete-one-item')?>';
</script>
<script language="javascript" type="text/javascript" src="js/admin/category/update.js" charset="utf-8"></script>
<div class="pad-lr-10">
    <form action="<?=Yii::$app->urlManager->createUrl('category/update-one')?>" id="categoryForm" name="categoryForm" method="post" target="iframeId">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th width="100">商品大类标识</th>
                        <td>
                            <?=$category->categoryCode?><input type="hidden" id="categoryCode" value="<?=$category->categoryCode?>"/>
                        </td>
                    </tr>
                    <tr>
                        <th width="100"><sub class="redstar">*</sub>商品大类名称</th>
                        <td>
	                        <input type="text" style="width:250px;height: 30px;" name="categoryName" id="categoryName" value="<?=$category->categoryName?>" class="input-text"/></td>
                    </tr>
                    <tr>
                        <th width="100">简介</th>
                        <td><textarea style="width:350px;height:80px;" id="intro" name="intro"><?=$category->intro?></textarea></td>
                    </tr>
                    <tr>
                        <th><sub class="redstar">*</sub>是否可用</th>
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
	                <th align="left">具体类别名称</th>
	                <th align="left">代买编码</th>
	                <th align="left">代卖编码</th>
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
                                <td align="left"><input name="categoryFullNames" class="input-text" type="text" value="<?=$categoryFull->categoryFullName?>" size="25" /></td>
                                <td align="left"><input name="buyCodes" class="input-text" type="text" value="<?=$categoryFull->buyCode?>" size="5" /></td>
	                            <td align="left"><input name="sellCodes" class="input-text" type="text" value="<?=$categoryFull->sellCode?>" size="5" /></td>
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