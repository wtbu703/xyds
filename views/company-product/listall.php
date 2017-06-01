<?php
$this->title = '产品列表';
?>
<script type="text/javascript">
    var pageUrl = "<?=yii::$app->urlManager->createUrl('company-product/find-by-attri')?>";
    var editUrl = "<?=yii::$app->urlManager->createUrl('company-product/update')?>";
    var deleteUrl = "<?=yii::$app->urlManager->createUrl('company-product/delete-one')?>"
    var deleteallUrl = "<?=yii::$app->urlManager->createUrl('company-product/delete-more')?>"
    var detailUrl = "<?=yii::$app->urlManager->createUrl('company-product/find-one')?>"
</script>
<script language="javascript" type="text/javascript" src="js/admin/company-product/listall.js" charset="utf-8"></script>

<div class="pad-lr-10">
    <div class="table-list">
        <table width="100%" cellspacing="0" id="user_list">
            <thead id="dict_list_head">
            <tr align="left">
                <th width="50px" align="left"><input type="checkbox" id='check_box' onclick="selectall('id')"/>全选/取消</th>
                <th width="30px" align="left">序号</th>
                <th width="160px" align="left">产品名称</th>
                <th width="60px" align="left">价格</th>
                <th width="20px" align="left">折扣</th>
                <th width="60px" align="left">状态</th>
                <th width="150px" align="center">操作</th>
            </tr>
            </thead>
            <tbody id="user_list_body">
            <?if(!is_null($companyProduct)){?>
            <?php foreach ($companyProduct as $index => $val){?>
                <tr align="left">
                    <td align="left"><input type="checkbox" id="id" name="id" value="<?=$val->id?>"/></td>
                    <td align="left"><?=$index+$pages->page*$pages->pageSize+1?></td>
                    <td align="left"><a href="javascript:detail('<?=$val->id?>','<?=$val->name?>')"><?php if(strlen($val->name)>24) {
                                echo mb_substr($val->name, 0, 8,"utf-8") . '...';
                            }else{
                                echo $val->name;
                            }?></a></td>
                    <td align="left"><?=$val->price?></td>
                    <td align="left"><?=$val->discount?></td>
                    <td align="left"><?=$val->state?></td>
                    <td align="center">
                        <a href="javascript:openedit('<?=$val->id?>','<?=$val->name?>')">修改</a>&nbsp;&nbsp;
                        |&nbsp;&nbsp;<a href="javascript:deleteCompanyProduct('<?=$val->id?>')">删除</a>
                    </td>
               </tr>
                <?}?>
                <?}?>
            </tbody>
        </table>
        <div class="btn">
            <label for="check_box"><input type="checkbox" id='check_box' onclick="selectall('id')"/>全选/取消</label>
            <input type="button" class="buttondel" name="dosubmit" value="删除" onclick="if (confirm('您确定要删除吗？')) delopt(0);"/>
            <input type="button" class="buttondel" name="on" value="上架" onclick="if (confirm('您确定要上架吗？')) delopt(1);"/>
            <input type="button" class="buttondel" name="up" value="下架" onclick="if (confirm('您确定要下架吗？')) delopt(2);"/>
        </div>
        <div id="pages">
            <a><?=$pages->totalCount?>条/<?=$pages->pageCount?>页</a>
            <input type="hidden" value="<?=$pages->page?>" id="curPage"/><!--当前页-->
            <input type="hidden" value="<?=$pages->pageCount?>" id="pageCount"/><!--总页数-->
            <input type="hidden" value="<?=$pages->pageSize?>" id="pageSize"/><!--每页显示数-->
            <?if($pages->page>0){?>
                <!-- 判断是否不是第一页 -->
                <a id="firstPageid" href="javascript:page('1')">首页</a>
                <a id="supPageId" href="javascript:page('2')">上一页</a>
            <?}?>
            <?=$pages->page+1?>
            <?if($pages->page<$pages->pageCount-1){?>
                <!-- 判断如果不是最后一页 -->
                <a id="nextPageid" href="javascript:page('3')">下一页</a>
                <a id="lastPageid" href="javascript:page('4')" class="a1">尾页</a>
            <?}?>
            <input type="text" size="2" class="input-text" value="<?=$pages->page+1?>" id="goPage"/><a href="javascript:page('0')">GO</a>
        </div>
    </div>
</div>
<form action="<?=yii::$app->urlManager->createUrl('company-product/find-by-attri')?>" method="get" id="pageForm">
    <input type="hidden" id="page" name="page" value="<?=$pages->page?>"/>
    <input type="hidden"  name="r" value="company-product/find-by-attri"/>
    <input type="hidden" id="pre-page" name="pre-page" value="<?=$pages->pageSize?>"/>
    <input type="hidden" id="name" name="name" value="<?=$para['name']?>"/>
</form>
