<?
$this->title = '信息公开详情页';
?>
<link rel="stylesheet" type="text/css" href="css/css/details_common.css">
<link rel="stylesheet" type="text/css" href="css/css/info_details.css">

<script type="text/javascript">
    var detail = "<?=yii::$app->urlManager->createUrl('front/info-detail')?>";
    var stateUrl = "<?=yii::$app->urlManager->createUrl('public-info/state')?>";
    var id = "<?=$info->id?>";
</script>
<script src="js/front/info_detials.js"></script>

<img src="<?=$pic?>" class="img-responsive"/>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-12 content_box">
            <div class="content_header">&nbsp;信息公开</div>
        </div>
    </div>
</div>
<div class="line"></div>
<!-- 主要内容 -->
   <div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content_right public_shadow" id="content_right">
            <div class="right_head">
                <div class="list_head">
                    <span class="lh_index"><img src="images/info_details/home.png" alt="首页图标">&nbsp;<a href='<?=Yii::$app->urlManager->createUrl('front/index');?>'>首页</a>&nbsp;></span>
                    <span class="lh_index"><a href="<?=Yii::$app->urlManager->createUrl('front/public-info');?>">信息公开</a>&nbsp;></span>
                    <!--<span class="lh_index"><a href='info.html'>招标信息</a>&nbsp;></span>-->
                    <span class="lh_index">详细</span>
                </div>
            </div>
                <div class="right_line"></div>
       <!-- 文章 -->
              <div class="art">
                     <div class="row">
                        <div class="col-xs-0 col-sm-0 col-md-2 col-lg-2"></div>
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                            <h2 class="art_title"><?=$info->title?></h2>
                        </div>
                        <div class="col-xs-0 col-sm-0 col-md-2 col-lg-2"></div>
                     </div>
                    <div class="pub_info">
                        <span>发布者：<?=$info->author?> 点击数：<?=$info->conunt?>次 更新时间：<?=substr($info->published,0,10)?></span>
                    </div>
                      <div class="col-xs-12 col-md-12 col-lg-12 process">
                          <div class="col-xs-0 col-md-3 col-lg-3"></div>
                          <div class="col-xs-12 col-md-6 col-lg-6 row_public">

                             <!-- <div class="img_title">招标最新进展</div>-->
                          </div>
                          <div class="col-xs-0 col-md-3 col-lg-3"></div>
                      </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                             <div class="art_box">
                                <ul class="art_info_2">
                                    <?=$info->content?>
                                </ul>
                             </div>
                         </div>

                         </div>
                    </div>

                    <?php if($info->attachName != ''){?>
                     <div class="art_down">附件：<a href="<?=$info->attachUrl?>"><u><?=$info->attachName?></u></a></div>
                    <?php }?>


                     <div class="art_box1"></div>
                     <div class="content_list">
                        <ul class="content_ul">
                            <?php
                            if($stitle != ''){?>
                                <?php
                                $stime = substr($spublished,0,10);
                                ?>
                                <li><div></div><a href="<?=Yii::$app->urlManager->createUrl('front/info-detail')?>&id=<?=$sid?>"><span>上一篇：<?=$stitle?> <h>&nbsp;<?=$stime?></h></span></a></li>
                            <?}?>
                            <?php
                            if($titles != ''){?>
                                <?php
                                $times = substr($publisheds,0,10);
                                ?>
                            <li><div></div><a href="<?=Yii::$app->urlManager->createUrl('front/info-detail')?>&id=<?=$ids?>"><span>下一篇：<?=$titles?> <h>&nbsp;<?=$times?></h></span></a></li>
                            <?}?>
                        </ul>
                     </div>
              </div>
        </div>

    </div>
</div>

