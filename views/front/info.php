<?
$this->title = '信息公开';
use yii\widgets\LinkPager;

?>
<link rel="stylesheet" type="text/css" href="css/css/details_common.css">
<link rel="stylesheet" type="text/css" href="css/css/info.css">
<script type="text/javascript">
    var dictUrl = "<?=yii::$app->urlManager->createUrl('dict/info')?>";
    var infoUrl = "<?=yii::$app->urlManager->createUrl('front/public-info')?>";
    var infoOneUrl = "<?=yii::$app->urlManager->createUrl('public-info/info-one')?>"
    var infoDetail = "<?=yii::$app->urlManager->createUrl('front/info-detail')?>";
    var stateUrl = "<?=yii::$app->urlManager->createUrl('public-info/state')?>";
</script>
<script src="js/front/info.js"></script>

<img src="images/info/banner_xxgk.jpg" class="img-responsive"/>

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
            <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3 ">  
                <ul class="list-group content_left public_shadow" id="content_left">
                    <!-- <li class="list_first"><img src="images/third_details/xinxi_icon1.png"><span>&nbsp;公告类型</span></li> -->
                    <!-- <li class="list_item1 "><a href='info.html'>政策指引</a></li>
                    <li class="list_item1 list_on"><a href='info.html'>招标信息</a></li>
                    <li class="list_item1"><a href='info.html'>企业咨询</a></li>
                    <li class="list_item1"><a href='info.html'>供求信息</a></li>
                    <li class="list_item1"><a href='info.html'>行业资讯</a></li> -->
                </ul>
            </div>
    <!-- 文章 -->
            <div class="col-xs-12 col-sm-8 col-md-9 col-lg-9 content_right public_shadow" id="content_right">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 ">
                    <img class="img-responsive icon2" src="images/info/icon2.png" alt="图标">
                    <h3>&nbsp;相关公告公示</h3>
                     <ul class="con_ul col-xs-12 col-sm-12 col-md-12 col-lg-12 publicity">
                         <?if(!is_null($info)){?>
                         <?php foreach ($info as $index => $val){?>
                                 <?php
                                 $time = substr($val->published,6,-9);
                                 ?>
                            <li><a href='<?=Yii::$app->urlManager->createUrl('front/info-detail')?>&id=<?=$val->id?>'><div></div><span><?=$val->title?></span><h class="con_h"> [<?=$time?>]</h></a></li>
                        <?}?>
                        <?}?>
                    </ul>
                    <?= LinkPager::widget([
                        'pagination' => $pagination,
                        'firstPageLabel' => '首页',
                        'lastPageLabel' => '尾页',
                        'maxButtonCount' => 5,
                    ]) ?>
                    <nav aria-label="Page navigation" class="content_page col-md-12 col-sm-12 col-xs-12">
                        <!--<ul class="pagination pagination-sm cont_circle">
                            <li><a href="#" aria-label="Previous">上页</a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a class="fen" href="#">...</a></li>
                            <li><a href="#">25</a></li>
                            <li><a href="#" aria-label="Next">下页</a></li>
                        </ul>-->
                    </nav>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 ">
                        <img class="img-responsive icon2" src="images/info/icon3.png">
                        <h3>&nbsp;招标最新进展</h3>
                        <div class="carousel-inner zixun_banner " >
                            <!--<div class="item active">
                                <a href="info_details.html"><img class="center-block" src="images/images_index/xinxi_1.jpg" alt="新闻图片" /></a>
                                <div class="zixun_text">
                                    <h5><a href="info_details.html">城市花园建设介绍</a></h5>
                                    <img src="images/images_index/zixun_lineblue.png" alt="">
                                    <p><a href="info_details.html">
                                        花园城市是为了促进城市发展而做出的努力，该项目的宗旨是服务社区，美化城市，让城市更加美丽，更加宜居。花园城市是为了促进城市发展而做出的努力，该项目的宗旨是服务社区，美化城市，让城市更加美丽，更加宜居。</a>
                                    </p>
                                </div>
                            </div>   -->
                        </div>  
                          <div class="col-xs-12 col-sm-12 col-md-12 row_public">
                            <div class="row">
                                <div class="col-xs-12 tender_title">
                                    <img class="" src="images/images_index/xinxi_icon1.png" alt="">
                                    <span>招标最新进展</span>
                                </div>
                            </div>
                              <!--<div class="row">
                                  <div class="col-xs-12 tender">
                                      <span class="col-xs-3 tender_process">招标公示</span>
                                      <img class="col-xs-1 img-responsive" src="images/images_index/xinxi_arrow3.png" alt="">
                                      <span class="col-xs-3 tender_process">招标报名</span>
                                      <img class="col-xs-1 " class="col-xs-1 img-responsive " src="images/images_index/xinxi_arrow3.png" alt="">
                                      <span class="col-xs-3 tender_process">资格审查</span>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-xs-12 tender tender_time">
                                      <span class="col-xs-3 ">2017.02.19</span>
                                      <div class="col-xs-1"></div>
                                      <span class="col-xs-3 ">2017.02.19</span>
                                      <div class="col-xs-1"></div>
                                      <span class="col-xs-3 ">2017.02.19</span>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-xs-12 tender_img ">
                                      <div class="col-xs-3"></div>
                                      <div class="col-xs-1"></div>
                                      <div class="col-xs-3"></div>
                                      <div class="col-xs-1"></div>
                                      <div class="col-xs-3">
                                          <img class=" " src="images/images_index/xinxi_arrow2.png" alt="">
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-xs-12 tender">
                                      <span class="col-xs-3 tender_process">
                                      缴保证金
                                      </span>
                                      <img class="col-xs-1 img-responsive" src="images/images_index/xinxi_arrow1.png" alt="">
                                      <span class="col-xs-3 tender_process">
                                      编制文件
                                      </span>
                                      <img class="col-xs-1 " class="col-xs-1 img-responsive " src="images/images_index/xinxi_arrow1.png" alt="">
                                      <span class="col-xs-3 active tender_process">
                                      招标答疑
                                      </span>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-xs-12 tender tender_time">
                                      <span class="col-xs-3 ">
                                          2017.03.10
                                      </span>
                                      <div class="col-xs-1"></div>
                                      <span class="col-xs-3 ">
                                          2017.03.15
                                      </span>
                                      <div class="col-xs-1"></div>
                                      <span class="col-xs-3 active_time">
                                          2017.03.20
                                      </span>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-xs-12 tender_img ">
                                      <div class="col-xs-3">
                                          <img class=" " src="images/images_index/xinxi_arrow2.png" alt="">
                                      </div>
                                      <div class="col-xs-1"></div>
                                      <div class="col-xs-3"></div>
                                      <div class="col-xs-1"></div>
                                      <div class="col-xs-3"></div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-xs-12 tender">
                                      <span class="col-xs-3 tender_process">
                                      开标定标
                                      </span>
                                      <img class="col-xs-1 img-responsive" src="images/images_index/xinxi_arrow3.png" alt="">
                                      <span class="col-xs-3 tender_process">中标公示
                                      </span>
                                      <img class="col-xs-1 " class="col-xs-1 img-responsive " src="images/images_index/xinxi_arrow3.png" alt="">
                                      <span class="col-xs-3 tender_process">
                                      发招标书
                                      </span>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-xs-12 tender tender_time">
                                      <span class="col-xs-3 ">
                                          2017.03.22
                                      </span>
                                      <div class="col-xs-1"></div>
                                      <span class="col-xs-3 ">
                                          2017.03.23
                                      </span>
                                      <div class="col-xs-1"></div>
                                      <span class="col-xs-3 ">
                                          2017.04.01
                                      </span>
                                  </div>
                              </div>  -->
                        </div>
                </div>     
        </div>
        </div>
    </div>

