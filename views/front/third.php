<?
$this->title = "第三方服务";
?>
<link rel="stylesheet" type="text/css" href="css/css/details_common.css">
<link rel="stylesheet" type="text/css" href="css/css/third.css"><!--右侧图片css-->

<script type="text/javascript">
    var thirdUrl = "<?=yii::$app->urlManager->createUrl('third-party-service/ajax')?>";
    var thirdDetailUrl = "<?=yii::$app->urlManager->createUrl('front/third-detail')?>";
    var dictUrl = "<?=yii::$app->urlManager->createUrl('dict/dict')?>";
</script>
<img src="images/thirdserve/banner_3disanfang.jpg" class="img-responsive"/>

<div class="content_body">
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-12 content_box">
            <div class="content_header">&nbsp; 第三方服务</div>
            <div class="content_search">
                <input type="text" class="form_2" id="thirdName" placeholder="请输入企业名称" />
               <button class="search_bg" onclick="searchByNameCat()"><center><img src="images/third_details/search.png" alt="搜索图标"></center></button>
            </div>
        </div>
    </div>
</div>
<div class="line"></div>
<!-- 主要内容 -->
   <div class="container box">
    <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3 ">
            <ul class="list-group content_left public_shadow" id="content_left">

            </ul>
        </div>
      <!--右边-->
       <div class="col-xs-12 col-sm-8 col-md-9 col-lg-9 right" id="content_right">
            <div>
                <div class="row_one"></div>

            </div>
        </div>
       </div>
    </div>
    <div class="container">
        <!--分页 -->
        <div class="row row_page">
            <div class="col-md-3 col-sm-1 col-xs-0 col-lg-4"></div>
            <nav aria-label="Page navigation" class="col-lg-5 col-md-7 col-sm-10 col-xs-12">
                <ul class="pagination pagination-lg col-md-12 col-sm-12 col-xs-12">

                </ul>
            </nav>
            <div class="col-md-2 col-sm-1 col-xs-0 col-lg-3"></div>
        </div>
    </div>
</div>
<script src="js/front/third.js"></script>


