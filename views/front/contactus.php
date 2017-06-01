<?
$this->title = '联系我们'
?>
<link rel="stylesheet" type="text/css" href="css/css/contactus.css">
<link href="css/common_css/style.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/css/details_common.css">
<script type="text/javascript" >
	var insertUrl = "<?=Yii::$app->urlManager->createUrl('front/con-add')?>";
</script>
<script type="text/javascript" src="js/front/common_js/Validform_v5.3.2_min.js"></script>
<script type="text/javascript" src="js/front/contactus.js"></script>
<script>
	$(function(){
		var demo=$(".registerform").Validform({
			tiptype:2,
			postonce:true,
			showAllError:true,
			ajaxPost:true
		});

	})
</script>

<img class="img-responsive hidden-xs" src="<?=$pic?>" alt="banner">


<!-- 主体 -->
<div class="container">
	<div class="row">
		<div class="col-xs-12 column">
			<div class="redbar">
			</div>
			<span>联系我们</span>
		</div>
	</div>
</div>
<div class="container">
	<div class="row row_top">
		<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
			<ul class="list-group content_left public_shadow " id="content_left">
				<li class="list_item1 "><a href="<?=Yii::$app->urlManager->createUrl('front/about')?>">关于我们</a></li>
				<li class="list_item1 list_on"><a href="<?=Yii::$app->urlManager->createUrl('front/contactus')?>">个人资料上传</a></li>
			</ul>
			<div class="gongao">联系我们</div>
		</div>

		<div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
			<div class="box clearfix">
				<div class="right_head">
					<div class="list_head">
						<span class="lh_index"><img class="img-responsive home" src="images/images_common/home.png" alt="首页图标"><a href="<?=Yii::$app->urlManager->createUrl('front/index')?>">首页</a>&nbsp;></span>
						<span class="lh_index"><a href="<?=Yii::$app->urlManager->createUrl('front/contactus')?>">联系我们</a>&nbsp;></span>
						<span class="lh_index">个人资料上传</span>
					</div>
				</div>
			</div>
			<hr />
			<div class="row">
					<div class="col-xs-12 ">
						<form class="form-horizontal registerform" id="myform" role="form">
							<div class="form-group has-feedback">
								<label for="" class="col-sm-2 control-label"><sub class="redstar">*</sub>真实姓名:</label>
								<div class="col-sm-5">
									<input type="text" value=""  id="name" class="form-control" datatype="/^[\u4e00-\u9fa5]+$/"  nullmsg="请输入姓名！" errormsg="昵称至少2个字符，最多18个字符！" placeholder="请输入您的真实姓名" />
								</div>
								<div class="col-sm-5">
									<div class="Validform_checktip"></div>
								</div>
							</div>
							<div class="form-group">
								<label for="" class="col-sm-2 control-label"><sub class="redstar">*</sub>性别:</label>
								<div class="col-sm-5">
									<input class="radio-inline" type="radio"  id="gender" name="gender" value="男" datatype="*" errormsg="请选择性别！" /><label>男</label> &nbsp;<input class="radio-inline" type="radio"  name="gender" value="女" id="gender" /><label>女</label>
								</div>
								<div class="col-sm-5">
									<div class="Validform_checktip"></div>
								</div>
							</div>
							<div class="form-group">
								<label for="" class="col-sm-2 control-label"><sub class="redstar">*</sub>电话:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="mobile" name="mobile" placeholder="请输入您的手机号码" datatype="/^1(3|4|5|7|8)[0-9]\d{8}$/"  nullmsg="请输入手机号码！" errormsg="请输入正确的手机号码！" >
								</div>
								<div class="col-sm-5">
									<div class="Validform_checktip"></div>
								</div>
							</div>
							<div class="form-group has-feedback">
								<label for="" class="col-sm-2 control-label"><sub class="redstar">*</sub>邮箱:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="email" name="email" placeholder="请输入您的邮箱地址" datatype="e"  nullmsg="请输入邮箱地址！" errormsg="请输入正确邮箱地址！">
								</div>
								<div class="col-sm-5">
									<div class="Validform_checktip"></div>
								</div>
							</div>
							<div class="form-group has-feedback">
								<label for="" class="col-sm-2 control-label">QQ:</label>
								<div class="col-sm-5">
									<input type="text" id="QQ" name="QQ" class="form-control" >
								</div>
							</div>
							<div class="form-group">
								<label for="leavingmessage" class="col-sm-2 control-label">补充内容:</label>
								<div class="col-sm-5">
									<textarea id="leavingmessage" class="form-control content"   rows="6" ></textarea>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="button" class="btn btn_common1" id="add">提交</button>
									<button type="reset" class="btn btn_common1">重新填写</button>
								</div>
							</div>
						</form>
					</div>
				</div>
		</div>
	</div>
</div>



