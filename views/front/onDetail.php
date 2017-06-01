<?
$this->title = "在线招聘详情页";
?>
<link rel="stylesheet" type="text/css" href="css/css/details_common.css">
<link rel="stylesheet" type="text/css" href="css/css/On_details.css">


<img src="<?=$pic?>" class="img-responsive"/>

<div class="con_body">
<!-- 主要内容 -->
   <div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content_right public_shadow" id="content_right">
            <div class="co">
            <img class="img-responsive onicon" src="images/On_details/icon.png">

            <span class="onname"><?=$companyRecruit->position?></span>
            <span class="onsalary"><?=$companyRecruit->salary?></span>
                <span class="online">|</span>
            <span class="onsalary1"><?=$companyRecruit->place?></span>
                <span class="online">|</span>
            <span class="onsalary1"><?=$companyRecruit->record?></span>
                <span class="online">|</span>
            <span class="onsalary1"><?=$companyRecruit->exp?></span>
            <div class="right_line"></div>
            <!-- 文章 -->
             <div class="content_post col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="post_ul col-xs-12 col-sm-12 col-md-12 col-lg-12">
                   <!-- <span class="position"><?/*=$companyRecruit->position*/?>  </span>
                    <span class="position_d"><?/*=$companyRecruit->workPlace*/?></span>
                    <span><?/*=$company->name*/?></span>
                    <span class="salary"><?/*=$companyRecruit->salary*/?></span>-->
                </div>


            </div>
                <div class="job_info col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="infoline"></div>
                    <span>职位信息 :</span>
                </div>
                <div class="description col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <?=$companyRecruit->demand?>
                </div>
                <div class="job_info col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="infoline"></div>
                    <span>联系方式 :</span>
                </div>
                <ul class="tel_info col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <?php if($companyRecruit->state == '1'){?>
                        <li>公司地址： <?=$company->address?></li>
                    <?}else{?>
                        <li>公司地址：xx县</li>
                    <?}?>
                    <li>联系人： <?=$companyRecruit->contacts?> </li>
                    <li>联系电话： <?=$companyRecruit->mobile?></li>
                    <li>邮箱：<?=$companyRecruit->email?></li>
                </ul>
                <div class="job_info col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="infoline"></div>
                    <span>公司信息 :</span>
                </div>
                <div class="company_info col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <?php if($companyRecruit->state == '1'){?>
                   <?=$company->introduction?>
                <?}else{?>
                    电子商务平台即是一个为企业或个人提供网上交易洽谈的平台。企业电子商务平台是建立在Internet网上进行商务活动的虚拟网络空间和保障商务顺利运营的管理环境；是协调、整合信息流、物质流、资金流有序、关联、高效流动的重要场所。企业、商家可充分利用电子商务平台提供的网络基础设施、支付平台、安全平台、管理平台等共享资源有效地、低成本地开展自己的商业活动。
                <?}?>
                </div>
        </div>
        </div>
        </div>
   </div>
</div>

