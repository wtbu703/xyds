<div class="pad-lr-10">
<form id="myform" action="" method="post">
    <div class="pad_10">
        <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
            <table width="100%" cellspacing="0" class="table_form contentWrap">
                <tr>
                    <th width="100">图片大类标识</th>
                    <td><?=$category->picCode?></td>
                </tr>
                <tr>
                    <th width="100">图片大类名称</th>
                    <td><?=$category->picName?></td>
                </tr>
                <tr>
                    <th width="100">简介</th>
                    <td><?=$category->intro?></td>
                </tr>
                <tr>
                    <th width="100">状态</th>
                    <td><?=$category->state?></td>
                </tr>
            </table>
        </div>
        <div class="bk10"></div>

        <div class="table-list">
            <table id="modelTplTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th align="left">排序</th>
                    <th align="left">图片</th>
                </tr>
                </thead>
                <tbody id="modelTplTB">
                    <?php if(!is_null($categoryFulls)){?>
                        <?php foreach ($categoryFulls as $index => $categoryFull){?>
                            <tr id="">
                                <td align="left"><?=$categoryFull->orderBy?></td>
                                <td align="left"><img width="200" height="200" src="<?=$categoryFull->picUrl?>" /></td>
                            </tr>
                        <?}?>
                    <?}?>
                </tbody>
            </table>
            <div class="rightbtn">
                <input type="button" class="buttonclose" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('category_detail').close();" />
            </div>
        </div>
</form>
</div>