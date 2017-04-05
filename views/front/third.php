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
                <li class="list_first"><img src="images/third_details/xinxi_icon1.png"><span>&nbsp;企业类型</span></li>
                 <!--<a href="third.html"><li class="list_item1 ">产品图片</li></a>
                <a href="third.html"><li class="list_item1 list_on">电子商务</li></a>
                <a href="third.html"><li class="list_item1">店铺运营</li></a>
                <a href="third.html"><li class="list_item1">网站建设</li></a>
                <a href="third.html"><li class="list_item1">产品设计</li></a>
                <a href="third.html"><li class="list_item1">流量推广</li></a>
                <a href="third.html"><li class="list_item1">客户服务</li></a>
                <a href="third.html"><li class="list_item1">订单管理</li></a>
                <a href="third.html"><li class="list_item1">数据分析</li></a>
                <a href="third.html"><li class="list_item1">仓储物流</li></a> -->
            </ul>
        </div>
      <!--右边-->
       <div class="col-xs-12 col-sm-8 col-md-9 col-lg-9 right" id="content_right">
            <div>
                <!-- 第一列 -->
                 <div class=" row_one">
                    <!-- <div class="col-md-4 col-sm-6 col-xs-12 enterprise">
                       <a href='third_details.html'>
                         <div class="box_shadow">
                            <img class="img-responsive" src="../images/thirdserve/dsf1.png" alt="企业图片">
                            <div class="row enterprise_detail col-md-12 col-sm-12 col-xs-12">
                                <h4>武汉商洋外贸有限公司</h4>
                                <div class="row redline">
                                    <div class="col-md-9 col-xs-9 col-sm-9 solid1"></div>
                                    <div class="col-md-3 col-xs-3 col-sm-3 dashed1"></div>
                                </div>
                                <div class="E-commerce">电子商务</div>
                            </div>
                         </div>
                       </a>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 enterprise">
                       <a href='third_details.html'>
                        <div class="box_shadow">
                            <img class="img-responsive" src="../images/thirdserve/dsf2.png" alt="企业图片">
                            <div class="row enterprise_detail col-md-12 col-sm-12 col-xs-12">
                                <h4>湖北商洋电子商务有限公司</h4>
                                <div class="row redline">
                                    <div class="col-md-9 col-xs-9 col-sm-9 solid1"></div>
                                    <div class="col-md-3 col-xs-3 col-sm-3 dashed1"></div>
                                </div>
                                <div class="E-commerce">电子商务</div>
                            </div>
                        </div>
                       </a>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 enterprise">
                      <a href='third_details.html'>
                        <div class="box_shadow">
                            <img class="img-responsive" src="../images/thirdserve/dsf3.png" alt="企业图片">
                            <div class="row enterprise_detail col-md-12 col-sm-12 col-xs-12">
                                <h4>长江实业有限公司</h4>
                                <div class="row redline">
                                    <div class="col-md-9 col-xs-9 col-sm-9 solid1"></div>
                                    <div class="col-md-3 col-xs-3 col-sm-3 dashed1"></div>
                                </div>
                                <div class="E-commerce">电子商务</div>
                            </div>
                        </div>
                      </a>
                    </div>   -->
                </div>
                <!-- end 第一列 -->
                <!-- 第二列 -->
                 <!-- <div class="row_one">
                    <div class="col-md-4 col-sm-6 col-xs-12 enterprise">
                      <a href='third_details.html'>
                        <div class="box_shadow">
                            <img class="img-responsive" src="../images/thirdserve/dsf4.png" alt="企业图片">
                            <div class="row enterprise_detail col-md-12 col-sm-12 col-xs-12">
                                <h4>赤壁溪寂环保有限公司</h4>
                                <div class="row redline">
                                    <div class="col-md-9 col-xs-9 col-sm-9 solid1"></div>
                                    <div class="col-md-3 col-xs-3 col-sm-3 dashed1"></div>
                                </div>
                                <div class="E-commerce">电子商务</div>
                            </div>
                        </div>
                     </a>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 enterprise">
                      <a href='third_details.html'>
                        <div class="box_shadow">
                            <img class="img-responsive" src="../images/thirdserve/dsf5.png" alt="企业图片">
                            <div class="row enterprise_detail col-md-12 col-sm-12 col-xs-12">
                                <h4>武汉力神塑业有限公司</h4>
                                <div class="row redline">
                                    <div class="col-md-9 col-xs-9 col-sm-9 solid1"></div>
                                    <div class="col-md-3 col-xs-3 col-sm-3 dashed1"></div>
                                </div>
                                <div class="E-commerce">电子商务</div>
                            </div>
                        </div>
                      </a>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 enterprise">
                      <a href='third_details.html'>
                        <div class="box_shadow">
                            <img class="img-responsive" src="../images/thirdserve/dsf6.png" alt="企业图片">
                            <div class="row enterprise_detail col-md-12 col-sm-12 col-xs-12">
                                <h4>湖北林岗外贸有限公司</h4>
                                <div class="row redline">
                                    <div class="col-md-9 col-xs-9 col-sm-9 solid1"></div>
                                    <div class="col-md-3 col-xs-3 col-sm-3 dashed1"></div>
                                </div>
                                <div  class="E-commerce">电子商务</div>
                            </div>
                        </div>
                      </a>
                    </div>
                </div> -->
                <!-- end 第二列 -->
                <!-- 第三列 -->
                 <!-- <div class=" row_one">
                    <div class="col-md-4 col-sm-6 col-xs-12 enterprise">
                      <a href='third_details.html'>
                        <div class="box_shadow">
                            <img class="img-responsive" src="../images/thirdserve/dsf7.png" alt="企业图片">
                            <div class="row enterprise_detail col-md-12 col-sm-12 col-xs-12">
                                <h4>武汉萧枫软件有限公司</h4>
                                <div class="row redline">
                                    <div class="col-md-9 col-xs-9 col-sm-9 solid1"></div>
                                    <div class="col-md-3 col-xs-3 col-sm-3 dashed1"></div>
                                </div>
                                <div class="E-commerce">电子商务</div>
                            </div>
                        </div>
                      </a>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 enterprise">
                      <a href='third_details.html'>
                        <div class="box_shadow">
                            <img class="img-responsive" src="../images/thirdserve/dsf8.png" alt="企业图片">
                            <div class="row enterprise_detail col-md-12 col-sm-12 col-xs-12">
                                <h4>湖北南方林木有限公司</h4>
                                <div class="row redline">
                                    <div class="col-md-9 col-xs-9 col-sm-9 solid1"></div>
                                    <div class="col-md-3 col-xs-3 col-sm-3 dashed1"></div>
                                </div>
                                <div class="E-commerce">电子商务</div>
                            </div>
                        </div>
                      </a>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 enterprise">
                      <a href='third_details.html'>
                        <div class="box_shadow">
                            <img class="img-responsive" src="../images/thirdserve/dsf9.png" alt="企业图片">
                            <div class="row enterprise_detail col-md-12 col-sm-12 col-xs-12">
                                <h4>武汉珞奥软件有限公司</h4>
                                <div class="row redline">
                                    <div class="col-md-9 col-xs-9 col-sm-9 solid1"></div>
                                    <div class="col-md-3 col-xs-3 col-sm-3 dashed1"></div>
                                </div>
                                <div  class="E-commerce">电子商务</div>
                            </div>
                        </div>
                      </a>
                    </div>
                </div>  -->
                <!-- end 第三列 -->
                <!-- 第四列 -->
                 <!-- <div class="row_one">
                    <div class="col-md-4 col-sm-6 col-xs-12 enterprise">
                      <a href='third_details.html'>
                        <div class="box_shadow">
                            <img class="img-responsive" src="../images/thirdserve/dsf10.png" alt="企业图片">
                            <div class="row enterprise_detail col-md-12 col-sm-12 col-xs-12">
                                <h4>湖北顺宇科技有限公司</h4>
                                <div class="row redline">
                                    <div class="col-md-9 col-xs-9 col-sm-9 solid1"></div>
                                    <div class="col-md-3 col-xs-3 col-sm-3 dashed1"></div>
                                </div>
                                <div class="E-commerce">电子商务</div>
                            </div>
                        </div>
                      </a>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 enterprise">
                      <a href='third_details.html'>
                        <div class="box_shadow">
                            <img class="img-responsive" src="../images/thirdserve/dsf11.png" alt="企业图片">
                            <div class="row enterprise_detail col-md-12 col-sm-12 col-xs-12">
                                <h4>天门顺枫科技有限公司</h4>
                                <div class="row redline">
                                    <div class="col-md-9 col-xs-9 col-sm-9 solid1"></div>
                                    <div class="col-md-3 col-xs-3 col-sm-3 dashed1"></div>
                                </div>
                                <div class="E-commerce">电子商务</div>
                            </div>
                        </div>
                      </a>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 enterprise">
                      <a href='third_details.html'>
                        <div class="box_shadow">
                            <img class="img-responsive" src="../images/thirdserve/dsf12.png" alt="企业图片">
                            <div class="row enterprise_detail col-md-12 col-sm-12 col-xs-12">
                                <h4>武汉画语软件有限公司</h4>
                                <div class="row redline">
                                    <div class="col-md-9 col-xs-9 col-sm-9 solid1"></div>
                                    <div class="col-md-3 col-xs-3 col-sm-3 dashed1"></div>
                                </div>
                                <div  class="E-commerce">电子商务</div>
                            </div>
                        </div>
                      </a>
                    </div>
                </div>  -->
                <!-- end 第四列 -->
            </div>
        </div>

       </div>
    </div>
</div>
<script src="js/front/third.js"></script>


