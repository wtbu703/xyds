<script type="text/javascript">

</script>
<script type="text/javascript" src="js/admin/"></script>

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

                </table>
            </div>
            <div class="bk10"></div>
        </div>
    </form>
    <div class="table-list">
        <div class="rightbtn">
            <input type="button" class="buttonsave" value="增加" name="dosubmit" onclick="add()" />
            <input type="button" class="buttonclose" value="关闭" name="dosubmit"  onclick="window.top.$.dialog.get('site_deal').close();"/>
        </div>
    </div>
</div>