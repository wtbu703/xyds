<?
$this->title = '培训详情页';
?>
<link rel="stylesheet" type="text/css" href="css/css/traindetail.css">

<!-- 文章正文部分 -->
<div class="wrapper">
	<div class="container">
		<div class="row content">

			<div class="col-md-12 col-sm-12 col-xs-12 article">
				<!-- 正文头部导航 -->
				<div class="right_head">
                    <div class="list_head">
                        <span class="lh_index"><img class="img-responsive home" src="images/images_common/home.png" alt="首页图标"><a href="<?=yii::$app->urlManager->createUrl('front/index')?>">首页</a>&nbsp;></span>
                        <span class="lh_index"><a href="<?=yii::$app->urlManager->createUrl('front/ectrain')?>">电商培训</a>&nbsp;></span>
                        <span class="lh_index"><a href="<?=yii::$app->urlManager->createUrl('front/train-notice')?>">培训通知</a>&nbsp;></span>
                        <span class="lh_index">详情</span>
                    </div>
                </div>
				<div class="row row_top">
					<div class="col-xs-12 col-md-12 col-lg-12 signup">
						<img class="img-responsive" src="images/images_contactus/signup.png" alt="baomonglogo">
						<h2>培训通知</h2>
					</div>
				</div>
                <!-- end 正文头部导航 -->
                <!-- 正文文章 -->
				<div class="row row_text1">
					<div class="col-md-1 col-sm-0 col-xs-0 col-lg-1"></div>
					<div class="col-md-10 col-sm-12 col-xs-12">
						<?if(!is_null($ectrain)){?>
						 <h2 style="text-align: center;">第<?=($ectrain->period)+1?>期<?=$ectrain->name?></h2>
						<div class="subhead">发布时间：&nbsp;<?=$ectrain->published?>&nbsp;发布人&nbsp;:&nbsp;<?=$ectrain->publisher?></div>
						<div class="col-md-offset-1 col-sm-offset-0 col-xs-offset-0 row_text">一、&nbsp;报名时间</div>
						<div class="col-md-offset-1 col-sm-offset-0 col-xs-offset-0 row_text">报名时间：<?=$ectrain->beginTime?>-<?=$ectrain->endTime?></div>
						<div class="col-md-offset-1 col-sm-offset-0 col-xs-offset-0 row_text">二、&nbsp;培训人数</div>
						<div class="col-md-offset-1 col-sm-offset-0 col-xs-offset-0 row_text">人数：<?=$ectrain->peopleNum?>人</div>
						<div class="col-md-offset-1 col-sm-offset-0 col-xs-offset-0 row_text">三、&nbsp;培训对象</div>
						<div class="col-md-offset-1 col-sm-offset-0 col-xs-offset-0 row_text"><?=$ectrain->target?></div>
						<div class="col-md-offset-1 col-sm-offset-0 col-xs-offset-0 row_text">四、&nbsp;培训内容</div>
						<div class="col-md-offset-1 col-sm-offset-0 col-xs-offset-0 row_text"><?=$ectrain->content?></div>
							<?php if($time>$ectrain->beginTime&&$time<$ectrain->endTime){ ?>
						<div class="down col-md-3 col-sm-3 col-md-offset-10 col-xs-offset-6"><a href="<?=Yii::$app->urlManager->createUrl('front/signup')?>&id=<?=$ectrain->id?>" class="btn btn_common1" role="button">报名入口</a>
						</div>
								<? }else{?>
								<div class="down col-md-3 col-sm-3 col-md-offset-10 col-xs-offset-6"><a class="btn btn_common2" role="button">报名入口</a></div>
									<?}?>
						<?}?>
					</div>
					<div class="col-md-1 col-sm-0 col-xs-0 col-lg-1"></div>
				</div>
				<!-- end 正文文章 -->
			</div>
		</div>
	</div>
</div>