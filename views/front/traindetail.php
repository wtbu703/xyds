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
                        <span class="lh_index"><a href="#">电商培训</a>&nbsp;></span>
                        <span class="lh_index"><a href="<?=yii::$app->urlManager->createUrl('front/train-notice')?>">培训通知</a>&nbsp;></span>
                        <span class="lh_index">详情</span>
                    </div>
                </div>
                <!-- end 正文头部导航 -->
                <!-- 正文文章 -->
				<div class="row row_text col-md-12">
					<div class="col-md-1 col-sm-0 col-xs-0 col-lg-1"></div>
					<div class="col-md-10 col-sm-12 col-xs-12">
						<?if(!is_null($ectrain)){?>
						 <h2 class="col-md-offset-3 col-sm-offset-2 col-xs-offset-1">第<?=($ectrain->period)+1?>期<?=$ectrain->name?></h2>
						<p class="col-md-offset-5 col-sm-offset-4 col-xs-offset-3 subhead"><img class="img-responsive clock" src="images/images_traindetail/time.png" alt="时钟图标">&nbsp;<?=$ectrain->published?>&nbsp;发布人&nbsp;:&nbsp;<?=$ectrain->publisher?></p>
						<p class="col-md-offset-1 col-sm-offset-0 col-xs-offset-0 row_text">一、&nbsp;培训时间</p>
						<p class="col-md-offset-1 col-sm-offset-0 col-xs-offset-0 row_text">培训时间：<?=$ectrain->beginTime?>-<?=$ectrain->endTime?></p>
						<p class="col-md-offset-1 col-sm-offset-0 col-xs-offset-0 row_text">二、&nbsp;培训人数</p>
						<p class="col-md-offset-1 col-sm-offset-0 col-xs-offset-0 row_text">人数：<?=$ectrain->peopleNum?>人</p>
						<p class="col-md-offset-1 col-sm-offset-0 col-xs-offset-0 row_text">三、&nbsp;培训对象</p>
						<p class="col-md-offset-1 col-sm-offset-0 col-xs-offset-0 row_text"><?=$ectrain->target?></p>
						<p class="col-md-offset-1 col-sm-offset-0 col-xs-offset-0 row_text">四、&nbsp;培训内容</p>
						<p class="col-md-offset-1 col-sm-offset-0 col-xs-offset-0 row_text"><?=$ectrain->content?></p>
						<div class="down col-md-3 col-sm-3 col-md-offset-10 col-xs-offset-6"><a href="<?=Yii::$app->urlManager->createUrl('front/signup')?>&id=<?=$ectrain->id?>" class="btn btn-primary btn-lg " role="button">报名入口</a>
						</div>
						<?}?>
					</div>
					<div class="col-md-1 col-sm-0 col-xs-0 col-lg-1"></div>
				</div>
				<!-- end 正文文章 -->
			</div>
		</div>
	</div>
</div>