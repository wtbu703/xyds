<script type="text/javascript">
	var saveUrl = "<?=Yii::$app->urlManager->createUrl('service-site-deal-table/add-one')?>";
	var indexUrl = "<?=Yii::$app->urlManager->createUrl('service-site-deal-table/index')?>";
</script>
<script type="text/javascript" src="js/admin/deal-table/deal.js"></script>

<div class="pad-lr-10">
    <form name="myform" action="" method="post" id="myform" target="iframeId">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th>站点编码：</th>
                        <td><?=$serviceSite['code']?></td>
	                    <input type="hidden" id="id" value="<?=$serviceSite['id']?>" />
                    </tr>
                    <tr>
                        <th>站点名称：</th>
                        <td><?=$serviceSite['name']?></td>
                    </tr>
	                <tr>
		                <th>代买商品类别：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="buyCategory" id="buyCategory"  class="input-text"/></td>
	                </tr>
	                <tr>
		                <th>代买总金额：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="buySum" id="buySum"  class="input-text"/></td>
	                </tr>
	                <tr>
		                <th>代买订单数：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="buyTotal" id="buyTotal"  class="input-text"/></td>
	                </tr>
	                <tr>
		                <th>销售商品类别：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="sellCategory" id="sellCategory"  class="input-text"/></td>
	                </tr>
	                <tr>
		                <th>销售总金额：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="sellSum" id="sellSum"  class="input-text"/></td>
	                </tr>
	                <tr>
		                <th>销售订单数：</th>
		                <td><input type="text" style="width:250px;height: 30px;" name="sellTotal" id="sellTotal"  class="input-text"/></td>
	                </tr>

                </table>
            </div>
            <div class="bk10"></div>
        </div>
    </form>
    <div class="table-list">
        <div class="rightbtn">
            <input type="button" class="buttonsave" value="增加" name="dosubmit" onclick="saveDealTable()" />
            <input type="button" class="buttonclose" value="关闭" name="dosubmit"  onclick="window.top.$.dialog.get('site_deal').close();"/>
        </div>
    </div>
</div>