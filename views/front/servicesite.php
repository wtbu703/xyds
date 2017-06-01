<?
$this->title = "服务站点";
?>
<style>
	.anchorBL{
        display: none;
    }
	.foWindow{
		height:40px;
	}
	.qw{
		text-align: center;
		font-size: 16px;
		font-family: '微软雅黑';
		color: #d52c40;
	}
	.zhanzhang{
		list-style: none;
		font-size: 14px;
		font-family: '宋体';
		color: #363636;
	}
	
	.detail{
		border:0px solid #fff;
		margin:0 auto;
		color:#fff;
		font-size: 12px;
		font-family: '宋体';
		background-color: #eb304d;
		width: 70px;
		height: 23px;
		border-radius: 3px;
		margin-left: 85px;
	}
	
	/* //左侧大盒子 */
	.detailBox{
		position: absolute;
		bottom:320px;
		left:1%; 
		width: 265px;
		height: 355px;
		background: #fff;
		-webkit-box-shadow:0 0 20px rgba(192, 184, 186, .5);  
  		-moz-box-shadow:0 0 20px rgba(192, 184, 186, .5);  
 		box-shadow:0 0 20px rgba(192, 184, 186, .5); 
 		display: none; 
	}
	.detailBox h2{
		text-align: left;
		font-size: 16px;
		font-family: '微软雅黑';
		color: #d52c40;
		padding-left:12px; 
		margin-top: 10px;
	}
	.pointList{
		padding-left:12px; 
		list-style: none;
	}
	.pointList li{
		margin: 3px auto;
	}
	.detailBox h1{
		font-size: 16px;
		font-weight: 700;
		text-align: center;
		padding-top: 13px;
		padding-bottom: 12px;
		margin:0px;
	}
	hr{
		margin:0px 12px;
		margin-bottom: 3px;
	}
	.address{
		padding-left:12px; 
	}
	.detailBox .address img{
		padding-right:5px; 
	}
	.detailBox .serviceMap{
		width:265px;
		height:137px;
	}
</style>
<link href="css/css/service_site.css" rel="stylesheet">
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=4cXNyMR23iSxTmEEzcyNcjdd6GuBvaef"></script>
<script src="js/front/InfoBox_min.js"></script>
<script src="js/front/service_site.js"></script>
<script type="text/javascript">
	var serviceSiteUrl = "<?=Yii::$app->urlManager->createUrl('service-site/service-site')?>";
</script>
<!-- container -->
<div id="allmap"></div>
<div class="boxC">
	<button id="back" class="clearfixed">回到中心点</button>
	<div class="detailBox">
		<!-- 接口 -->
	</div>  
</div>


	
<!-- container end -->
