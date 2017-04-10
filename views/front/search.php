<?
$this->title = "搜索";
?>
<link rel="stylesheet" type="text/css" href="css/css/search.css">
<script type="text/javascript">
	var searchUrl = "<?=Yii::$app->urlManager->createUrl('front/find-more')?>";
</script>
<script src="js/front/search.js"></script>

<div class="container">
	<div class="row">
		<div class="col-xs-0 col-md-2 col-lg-2"></div>
		<div class="col-xs-12 col-md-8 col-lg-8 content">
			<div class="col-xs-12 col-md-12 col-lg-12 content_top">
				<img class="img-responsive" src='images/images_common/home_icon.png' />
				<span>为您找到相关搜索为<?=$count?>个</span>
			</div>
			<div class="col-xs-12 col-md-12 col-lg-12 content_con">
				<div class="content_box">
					<?if(!is_null($article)){?>
					<?php foreach ($article as $index => $val){?>
					<h4><?=$val->title?></h4>
					<div class="content_info">
						<span>类别：<?=$val->category?> </span>
						<span>来源：<?=$val->author?> </span>
						<span>时间：<?=$val->datetime?> </span>
						<span>关键词：<?=$val->keyword?> </span>
					</div>
					<p><?=$val->content?></p>
						<?}?>
					<?}?>
				</div>
					<div class="content_line"></div>
				<div class="content_box">
					<?if(!is_null($companyNews)){?>
						<?php foreach ($companyNews as $index => $val){?>
							<h4><?=$val->title?></h4>
							<div class="content_info">
								<span>类别：<?=$val->category?> </span>
								<span>来源：<?=$val->author?> </span>
								<span>时间：<?=$val->published?> </span>
								<span>关键词：<?=$val->keyword?> </span>
							</div>
							<p><?=$content?></p>
						<?}?>
					<?}?>
				</div>
					<div class="content_line"></div>
			</div>
		</div>
		<div class="col-xs-0 col-md-2 col-lg-2"></div>
	</div>
</div>
<div class="container">
	<!--分页 -->
	<div class="row row_page">
		<div class="col-md-2 col-sm-1 col-xs-0 col-lg-3"></div>
		<nav aria-label="Page navigation" class="col-md-8 col-sm-10 col-xs-12">
		  <ul class="pagination pagination-lg">
			<li><a href="#" aria-label="Previous">
				上一页</a>
			</li>
			<li><a href="#">1</a></li>
			<li><a href="#">2</a></li>
			<li><a href="#">3</a></li>
			<li><a href="#">4</a></li>
			<li><a href="#">5</a></li>
			<li><a class="fen" href="#">...</a></li>
			<li><a href="#">25</a></li>
			<li>
			  <a href="#" aria-label="Next">
				下一页
			  </a>
			</li>
		  </ul>
		</nav>
		<div class="col-md-2 col-sm-1 col-xs-0 col-lg-3"></div>
	</div>
</div>