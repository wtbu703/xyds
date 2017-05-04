<?
$this->title = "在线招聘";
?>
<link rel="stylesheet" type="text/css" href="css/css/details_common.css">
<link rel="stylesheet" type="text/css" href="css/css/Online.css">
<script type="text/javascript">
    var positionUrl = "<?=yii::$app->urlManager->createUrl('company-recruit/positions')?>";
    var searchUrl = "<?=yii::$app->urlManager->createUrl('company-recruit/search')?>";
    var detailUrl = "<?=yii::$app->urlManager->createUrl('front/detail')?>";
</script>
<script src="js/front/Online.js"></script>

<img src="images/On_details/banner.jpg" class="img-responsive"/>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-12 content_box">
            <div class="content_header">&nbsp;在线招聘</div>
        </div>
    </div>
</div>
<div class="line"></div>
<!-- 主要内容 -->
   <div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3 ">
            <ul class="list-group content_left public_shadow " id="content_left">
                <li class="list_first"><img src="images/third_details/xinxi_icon1.png"><span>&nbsp;职位列表</span></li>
                <a href="javascript:positionMessage('0')"><li class="list_item1 list_on">全部职位</li></a>
                <a href="javascript:positionMessage('1')"><li class="list_item1 ">最新职位</li></a>
                <a href="javascript:positionMessage('2')"><li class="list_item1 ">热门职位</li></a>
            </ul>
        </div>
<!--右边部分-->
    <div class="col-xs-12 col-sm-8 col-md-9 col-lg-9 content_right public_shadow" id="content_right">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2"></div>
            <div class="full_text col-xs-12 col-sm-12 col-md-7 col-lg-7">
                <ul class="full_ul ">
                    <li class="full_li full_active ">全文</li>
                    <li class="full_li">职位</li>
                </ul>
                <div class="full_search col-xs-12 col-sm-12 col-md-12 col-lg-12">

                    <input class="sea_1" type="text" placeholder="请输入关键字" id="oninput"/>
                    <button type="button" onclick="ulClick();" id="contentSearch"><img src="images/Online/search .png">&nbsp;搜索</button>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3"></div>
        </div>
        <div class="recommend col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <span>推荐职位</span>

                <div class="recommend_line"></div>
        </div>
          <div class="detial col-xs-12 col-sm-12 col-md-12 col-lg-12">

        </div>

         <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <a  class="down_" id="get_more"><div class="down_more">点击加载更多</div></a>
        </div>
    </div>
    </div>
</div>

