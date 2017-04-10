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

<img src="images/info_details/banner_xxgkxq.jpg" class="img-responsive"/>
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
                    <span class="lh_index"><img src="images/info_details/home.png" alt="首页图标">&nbsp;<a href='index.html'>首页</a>&nbsp;></span>
                    <span class="lh_index"><a href='info.html'>信息公开</a>&nbsp;></span>
                    <span class="lh_index"><a href='info.html'>招标信息</a>&nbsp;></span>
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
                        <span>文章来源：<?=$info->author?> 点击数：<?=$info->conunt?>次 更新时间：<?=$info->published?></span>
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
                      <!--<div class="art_content_1">
                        <div class="art_info_2">
                            <span>2、投标人资格标准</span><br/>
                            <span>（1）投标人须是在中华人民共和国境内依照中华人民共和国法律注册的合法企业，具有独立的企业法人资格，具有有效的营业执照。</span><br/>
                            <span>（2）投标人注册资金不低于6000万元（含6000万元），以营业执照注册资金为准。</span><br/>
                            <span>（3）与招标人存在利害关系可能影响招标公正性的法人、其他组织或者个人，不得参加投标；单位负责人为同一人或者存在控股、管理关系的不同单位，不得同时参加本项目投标；集团公司中母公司与子公司不得同时参加本项目投标；同一公司具有独立法人的子公司不得同时参加本项目投标（以投标登记的先后顺序为准）。</span><br/>
                            <span>（4）本次招标不接受企业联合投标。</span>
                        </div>

                        <div class="art_info_2">
                            <span>8、投标地点及开标地点：详见招标文件。</span><br/>
                            <span>招标人：黑龙江省发展和改革委员会</span><br/>
                            <span>地 址：哈尔滨市南岗区中山路202号</span><br/>
                            <span>联系人：郭笑语 </span><br/>
                            <span>联系电话：0451-82633607</span>
                        </div>
                     </div>-->
                    <?php if($info->attachName != ''){?>
                     <div class="art_down">附件：<a href="<?=$info->attachUrl?>"><u><?=$info->attachName?></u></a></div>
                    <?php }?>
                     <div class="col-xs-12 col-md-12 col-lg-12 process">
                        <div class="col-xs-0 col-md-3 col-lg-3"></div>
                        <div class="col-xs-12 col-md-6 col-lg-6 row_public">
                            <!--<div class="row">
                                <div class="col-xs-12 tender">
                                    <span class="col-xs-3 tender_process">
                                    招标公示
                                    </span>
                                    <img class="col-xs-1 img-responsive" src="images/images_index/xinxi_arrow3.png" alt="">
                                    <span class="col-xs-3 tender_process">招标保名
                                    </span>
                                    <img class="col-xs-1 " class="col-xs-1 img-responsive " src="images/images_index/xinxi_arrow3.png" alt="">
                                    <span class="col-xs-3 tender_process">
                                    资格审查
                                    </span>
                                </div>
                            </div>
                        <div class="row">
                            <div class="col-xs-12 tender tender_time">
                                <span class="col-xs-3 ">
                                    2017.02.19
                                </span>
                                <div class="col-xs-1"></div>
                                <span class="col-xs-3 ">
                                    2017.02.19
                                </span>
                                <div class="col-xs-1"></div>
                                <span class="col-xs-3 ">
                                    2017.02.19
                                </span>
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
                        </div>-->
                        <div class="img_title">招标最新进展</div>
                        </div>
                        <div class="col-xs-0 col-md-3 col-lg-3"></div>
                      </div>

                     <div class="art_box1"></div>
                     <div class="content_list">
                        <ul class="content_ul">
                            <?php
                            if(!is_null($stitle)){?>
                                <?php
                                $time = substr($spublished,6,-9);
                                ?>
                                <li><div></div><a href="<?=Yii::$app->urlManager->createUrl('front/info-detail')?>&id=<?=$sid?>"><span>上一篇: <?=$stitle?> <h>&nbsp;2017-02-08</h></span></a></li>
                            <?}?>
                            <?php
                            if(!is_null($titles)){?>
                                <?php
                                $time = substr($publisheds,6,-9);
                                ?>
                            <li><div></div><a href="<?=Yii::$app->urlManager->createUrl('front/info-detail')?>&id=<?=$sid?>"><span>下一篇：<?=$titles?> <h>&nbsp;2017-02-08</h></span></a></li>
                            <?}?>
                        </ul>
                     </div>
              </div>
        </div>

    </div>
</div>

