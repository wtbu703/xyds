<?
$this->title = "电商培训报名";
?>
<link rel="stylesheet" type="text/css" href="css/css/account_common.css">
<link rel="stylesheet" type="text/css" href="css/common_css/style.css">

<script type="text/javascript">
	var addUrl = "<?=Yii::$app->urlManager->createUrl('front/sign')?>";
</script>

<script type="text/javascript" src="js/front/signup.js"></script>
<img class="img-responsive hidden-xs" src="images/images_contactus/banner.jpg" alt="banner">
<!-- 主体 -->
<div class="fluid-container BG">
	<div class="content">
		<div class="row row_top">
			<div class="col-md-1 col-lg-2"></div>
			<div class="col-xs-12 col-md-10 col-lg-8 signup">
				<img class="img-responsive" src="images/images_contactus/signup.png" alt="baomonglogo">
				<h2>欢迎报名</h2>
			</div>
			<div class="col-md-1 col-lg-2"></div>
		</div>
		<div class="row">
			<div class="col-md-1 col-lg-2"></div>
			<div class="col-xs-12 col-md-10 col-lg-8 bottom">
				<form class="form-horizontal registerform" role="form" action="<?=Yii::$app->urlManager->createUrl('front/xxx')?>">
					<div class="form-group">
						<label for="" class="col-sm-4 col-md-4 control-label"><sub class="redstar">*</sub>姓名:</label>
						<div class="col-sm-4 col-md-4">
							<input type="hidden" value="<?=$trainId?>" id="trainId" name="trainId" />
							<input type="text" value="" id="name" name="name" class="form-control" datatype="/^[\u4e00-\u9fa5]+$/"  nullmsg="请输入姓名！" errormsg="昵称应为2至18个字符的中文！" placeholder="请输入您的真实姓名" />
						</div>
						<div class="col-sm-4 col-md-4">
							<div class="Validform_checktip"></div>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-4 col-md-4 control-label"><sub class="redstar">*</sub>性别:</label>
						<div class="col-sm-4 col-md-4">
							<input class="radio-inline" type="radio" id="gender" name="gender" value="0"  datatype="*" errormsg="请选择性别！" /><label>男</label> &nbsp;<input class="radio-inline" type="radio" value="1" id="gender" name="gender"/><label>女</label>
						</div>
						<div class="col-sm-4 col-md-4">
							<div class="Validform_checktip"></div>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-4 col-md-4 control-label"><sub class="redstar">*</sub>年龄:</label>
						<div class="col-sm-4 col-md-4">
							<input type="text" datatype="/^(?:[1-9][0-9]?|1[01][0-9]|120)$/" class="form-control" name="age" id="age" errormsg="请输入正确的年龄" nullmsg="请输入年龄">
						</div>
						<div class="col-sm-4 col-md-4">
							<div class="Validform_checktip"></div>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-4 col-md-4 control-label"><sub class="redstar">*</sub>身份证号码:</label>
						<div class="col-sm-4 col-md-4">
							<input type="text" datatype="idcard" class="form-control" id="idCardNo" name="idCardNo" errormsg="请输入正确的身份证号码！" nullmsg="请输入身份证号码！">
						</div>
						<div class="col-sm-4 col-md-4">
							<div class="Validform_checktip"></div>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-4 col-md-4 control-label"><sub class="redstar">*</sub>手机号:</label>
						<div class="col-sm-4 col-md-4">
							<input type="text" datatype="m" class="form-control" id="mobile" name="mobile" errormsg="请输入正确的手机号！" nullmsg="请输入手机号！">
						</div>
						<div class="col-sm-4 col-md-4">
							<div class="Validform_checktip"></div>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-4 col-md-4 control-label">联系地址:</label>
						<div class="col-sm-4 col-md-4">
							<input type="text" id="address" name="address" class="form-control">
						</div>
						<div class="col-sm-4 col-md-4">
							<div class="Validform_checktip"><span class="register-gray">此空为选填项</span></div>
						</div>
					</div>
					<div>
						<input type="button" name="" value="立即报名" onclick="add()" class="btn">
					</div>
				</form>
			</div>
			<div class="col-md-1 col-lg-2"></div>
		</div>
	</div>
</div>
<!-- 主体结束 -->

<script type="text/javascript" src="js/front/common_js/Validform_v5.3.2.js"></script>
<script>
$(function(){
	//$(".registerform").Validform();  //就这一行代码！;

	/**********************
	传入自定义datatype类型【方式一】;
	$.extend($.Datatype,{
		"z2-4" : /^[\u4E00-\u9FA5\uf900-\ufa2d]{2,4}$/
	});
	**********************/

	$(".registerform").Validform({
		tiptype:2,
		datatype:{//传入自定义datatype类型【方式二】;
			"idcard":function(gets,obj,curform,datatype){
				//该方法由佚名网友提供;

				var Wi = [ 7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2, 1 ];// 加权因子;
				var ValideCode = [ 1, 0, 10, 9, 8, 7, 6, 5, 4, 3, 2 ];// 身份证验证位值，10代表X;

				if (gets.length == 15) {
					return isValidityBrithBy15IdCard(gets);
				}else if (gets.length == 18){
					var a_idCard = gets.split("");// 得到身份证数组
					if (isValidityBrithBy18IdCard(gets)&&isTrueValidateCodeBy18IdCard(a_idCard)) {
						return true;
					}
					return false;
				}
				return false;

				function isTrueValidateCodeBy18IdCard(a_idCard) {
					var sum = 0; // 声明加权求和变量
					if (a_idCard[17].toLowerCase() == 'x') {
						a_idCard[17] = 10;// 将最后位为x的验证码替换为10方便后续操作
					}
					for ( var i = 0; i < 17; i++) {
						sum += Wi[i] * a_idCard[i];// 加权求和
					}
					valCodePosition = sum % 11;// 得到验证码所位置
					if (a_idCard[17] == ValideCode[valCodePosition]) {
						return true;
					}
					return false;
				}

				function isValidityBrithBy18IdCard(idCard18){
					var year = idCard18.substring(6,10);
					var month = idCard18.substring(10,12);
					var day = idCard18.substring(12,14);
					var temp_date = new Date(year,parseFloat(month)-1,parseFloat(day));
					// 这里用getFullYear()获取年份，避免千年虫问题
					if(temp_date.getFullYear()!=parseFloat(year) || temp_date.getMonth()!=parseFloat(month)-1 || temp_date.getDate()!=parseFloat(day)){
						return false;
					}
					return true;
				}

				function isValidityBrithBy15IdCard(idCard15){
					var year =  idCard15.substring(6,8);
					var month = idCard15.substring(8,10);
					var day = idCard15.substring(10,12);
					var temp_date = new Date(year,parseFloat(month)-1,parseFloat(day));
					// 对于老身份证中的你年龄则不需考虑千年虫问题而使用getYear()方法
					if(temp_date.getYear()!=parseFloat(year) || temp_date.getMonth()!=parseFloat(month)-1 || temp_date.getDate()!=parseFloat(day)){
						return false;
					}
					return true;
				}

			}

		}
	});
})
</script>
