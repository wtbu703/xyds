<?
$this->title = "在线招聘";
?>
<link rel="stylesheet" type="text/css" href="css/css/details_common.css">
<link rel="stylesheet" type="text/css" href="css/css/Online.css">
<script type="text/javascript">
    var positionUrl = "<?=yii::$app->urlManager->createUrl('company-recruit/positions')?>";
    var seachUrl = "<?=yii::$app->urlManager->createUrl('company-recruit/seach')?>";
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
                <a href="javascript:positionMessage('0')"><li class="list_item1 ">最新职位</li></a>
                <a href="javascript:positionMessage('1')"><li class="list_item1 ">推荐职位</li></a>
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
                    <li class="full_li">公司</li>
                </ul>
                <div class="full_search col-xs-12 col-sm-12 col-md-12 col-lg-12">

                    <input class="sea_1" type="text" placeholder="请输入关键字" />
                    <button type="button" onclick="ulClick();" id="contentSearch"><img src="images/Online/search .png">&nbsp;搜索</button>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3"></div>
        </div>
        <div class="recommend col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <span>推荐职位</span>
                <!--<a href="#"><img src="images/Online/refresh.png"></a>-->
                <div class="recommend_line"></div>
        </div>
          <div class="detial col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <!-- <h4>产品经理</h4>
            <p>武汉市武汉工商学院  |  武汉  |  本科以上  |  2年经验  |  <span>8-10K</span></p>
            <div class='det_text'><p>1.3年以上互联网产品设计经验或游戏产品设计经验，具有移动互联网优秀产品经验优先； 2.了解最新的移动互联网动态
信息，熟练掌握主流产品设计工具； 3.具备较强的沟通协调能力、分析能力、执行力、逻辑分析能力、数据分析力，善于倾听用户声音；</p></div>
            <a href='On_details.html'>>>详情</a>
            <div class="detial_line"></div>-->
        </div>

         <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <a href="#" class="down_" id="get_more"><div class="down_more">点击加载更多</div></a>
        </div>
    </div>
    </div>
</div>

