<?
$this->title = "在线招聘详情页";
?>
<link rel="stylesheet" type="text/css" href="css/css/details_common.css">
<link rel="stylesheet" type="text/css" href="css/css/On_details.css">

<script src="js/front/On_detials.js"></script>
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
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content_right public_shadow" id="content_right">
            <div class="right_head">
                <div class="list_head">
                    <span class="lh_index"><img src="images/info_details/home.png" alt="首页图标" class="third_home">&nbsp;<a href='index.html'>首页</a>&nbsp;></span>
                    <span class="lh_index"><a href='online.php'>在线招聘</a>&nbsp;></span>
                    <span class="lh_index">职位详情</span>
                </div>
            </div>
            <div class="right_line"></div>
            <!-- 文章 -->
             <div class="content_post col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="post_ul col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <span class="position"><?=$companyRecruit->position?>  </span>
                    <span class="position_d"><?=$companyRecruit->workPlace?></span>
                    <span><?=$company->name?></span>
                    <span class="salary"><?=$companyRecruit->salary?></span>
                </div>


            </div>
                <div class="job_info col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <span>职位信息</span>
                </div>
                <ul class="description col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <?=$companyRecruit->demand?>
                </ul>
                <div class="job_tel col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <span>联系方式</span>
                </div>
                <ul class="tel_info col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <li>公司地址： <?=$company->address?></li>
                    <li>联系人： <?=$companyRecruit->contacts?> </li>
                    <li>联系电话： <?=$companyRecruit->mobile?></li>
                    <li>邮箱：<?=$companyRecruit->email?></li>
                </ul>
                <div class="job_tel col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <span>公司信息</span>
                </div>
                <div class="company_info col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <?=$company->introduction?>
                </div>
        </div>
        </div>
        </div>


