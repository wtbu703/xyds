<?
$this->title = "第三方服务详情页";
?>
    <link rel="stylesheet" type="text/css" href="css/css/details_common.css">
    <link rel="stylesheet" type="text/css" href="css/css/third_details.css">
    <script type="text/javascript">
        var thirdDetailUrl = "<?=yii::$app->urlManager->createUrl('third-party-service/ajax')?>";
        var dictUrl = "<?=yii::$app->urlManager->createUrl('dict/dict')?>";
        var datetime = "<?=$thirdDetail->datetime?>";
        var publicTime = "<?=$thirdDetail->publicTime?>";
    </script>

    <!--banner图-->
    <img src="images/third_details/banner_dafxq.jpg" class="img-responsive"/>

  <div class="content_body">    
	<div class="container">
    	<div class="row">
			<div class="col-xs-12 col-md-12 content_box">	
				<div class="content_header">&nbsp; 第三方服务</div>
			</div>
		</div>
	</div>
    <div class="line"></div>
    <!-- 主要内容 -->
       <div class="container box" onload="changeHeight()">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content_right public_shadow" id="content_right">
               	<div class="right_head"> 
                	<div class="list_head">
                    	<span class="lh_index"><a href="<?=Yii::$app->urlManager->createUrl('front/index')?>"><img src="images/third_details/home.png" alt="首页图标" class="third_home">&nbsp;首页</a>&nbsp;></span>
                        <span class="lh_index"><a href="<?=Yii::$app->urlManager->createUrl('front/third')?>">第三方服务</a>&nbsp;></span>
                        <!--<span class="lh_index"><a href='third.html'><?/*=$thirdDetail->category*/?></a>&nbsp;></span>-->
                        <span class="lh_index"><?=$thirdDetail->companyName?></span>
                    </div>  
                </div>
                	<div class="right_line"></div>
           <!-- 文章 -->
                   <div class="art">
                        <h2><?=$thirdDetail->companyName?></h2>
                        <div class="pub_info">
                            <span>内容来源：<?=$thirdDetail->sources?> 点击数：<?=$thirdDetail->count?>次 更新时间：</span><span id="upTime"></span>
                        </div>
                       <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                             <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <img class="third_art" src="<?=$thirdDetail->logoUrl?>" >
                             </div>
                             <div class="art_box col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                <ul class="art_info">
                                    <li>公司名称：<?=$thirdDetail->companyName?></li>
                                    <li>服务名称：<?=$thirdDetail->introduction?></li>
                                    <li>发布日期：<span class="pubtime"></span></li>
                                    <li>联系人：<?=$thirdDetail->contact?></li>
                                    <li>联系电话：<?=$thirdDetail->tel?></li>
                                    <li>电子邮箱：<?=$thirdDetail->email?></li>
                                    <li>联系地址：<?=$thirdDetail->address?></li>
                                </ul>
                             </div>
                       </div>
                         <div class="art_content">
                            <div class="art_info_1 art_content_1">
                                <?=$thirdDetail->content?>
                            </div>
                         </div> 
                         <div class="art_box1"></div>
                  </div> 
            </div>
            
        </div>
    </div>
</div>

<script src="js/front/third_details.js"></script>

