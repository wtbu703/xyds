<?php
/**
 * Created by PhpStorm.
 * User: liluoao
 * Date: 2017/1/18
 * Time: 18:34
 */

use yii\helpers\Html;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?><!--生成一个替换字符，表示css和js的引用代码在这里显示-->

	<!--核心CSS-->
	<link href="css/admin/reset.css" rel="stylesheet" type="text/css">
	<link href="css/admin/system.css" rel="stylesheet" type="text/css">
	<link href="css/admin/public.css" rel="stylesheet" type="text/css">
	<link href="css/admin/table_form.css" rel="stylesheet" type="text/css">
	<!--TAB样式-->
	<link href="css/tabpanel/core.css" rel="stylesheet" type="text/css">
	<link href="css/tabpanel/TabPanel.css" rel="stylesheet" type="text/css">
	<link href="css/tabpanel/Toolbar.css" rel="stylesheet" type="text/css">
	<link href="css/tabpanel/WindowPanel.css" rel="stylesheet" type="text/css">

	<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
	<!--弹窗-->
	<script type="text/javascript" src="js/dialog/dialog.js"></script>
	<script type="text/javascript" src="js/admin/styleswitch.js"></script>
	<script type="text/javascript" src="js/admin/hotkeys.js"></script>
	<script type="text/javascript" src="js/admin/jquery.sGallery.js"></script>
	<!--表单验证-->
	<script language="javascript" type="text/javascript" src="js/admin/formvalidatorregex.js" charset="utf-8"></script>
	<script language="javascript" type="text/javascript" src="js/admin/formvalidator.js" charset="utf-8"></script>
	<!--TAB JS-->
	<script type="text/javascript" src="js/tabpanel/Fader.js"></script>
	<script type="text/javascript" src="js/tabpanel/TabPanel.js"></script>
	<script type="text/javascript" src="js/tabpanel/Math.uuid.js"></script>
	<script type="text/javascript" src="js/tabpanel/Toolbar.js"></script>
	<script type="text/javascript" src="js/tabpanel/WindowPanel.js"></script>
	<script type="text/javascript" src="js/tabpanel/Drag.js"></script>
	<!--弹出图片-->
	<script type="text/javascript" src="js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
	<!--公共函数-->
	<script type="text/javascript" src="js/common.js"></script>
	<script language="javascript" type="text/javascript" src="js/page.js" charset="utf-8"></script>
</head>
<body>
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
