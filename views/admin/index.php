<?php

use yii\helpers\Html;

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?><!--生成一个替换字符，表示css和js的引用代码在这里显示-->
    <link href="css/admin/login.css" rel="stylesheet" type="text/css" />
    <script language="javascript" src="js/jquery-1.4.2.min.js"></script>

    <script>
        var logincheckUrl = "<?=yii::$app->urlManager->createUrl('admin/logincheck')?>";
        var backendUrl = "<?=yii::$app->urlManager->createUrl('admin/backend')?>";
    </script>
    <script language="javascript" src="js/admin/login.js"></script>
</head>
<body>
    <div id="OutBox">
        <div class="Top"></div>
        <div class="Mid">
            <div class="Left"></div>
            <div class="Right">
                <form action=""  method="post" id="LoginForm">
                    <input type="hidden" name="sessionId" id="sessionId" value="" />
                    <table border="0" cellpadding="0" cellspacing="0">
                        <tr style="height: 20px;">
                            <td colspan="2" class = 'nameTip' style = 'text-align: center;margin:0;padding:0;color:red;'></td>
                        </tr>
                        <tr>
                            <th scope="row">用户名：</th>
                            <td>
                                <label>
                                    <input name="username" type="text" class="longTextBox" onkeydown="SubmitKey('sumButton',event)"/>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">密　码：</th>
                            <td>
                                <label>
                                    <input class="longTextBox" name="password" type="password" onkeydown="SubmitKey('sumButton',event)"/>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">验证码：</th>
                            <td>
                                <label>
                                    <input class="shortTextBox" name="checkCode" type="text" onkeydown="SubmitKey('sumButton',event)"/>

                                    <img id="certImg" src="<?=yii::$app->urlManager->createUrl('admin/captcha')?>"  onclick= "this.src='<?=yii::$app->urlManager->createUrl('admin/captcha')?>&d='+Math.random();" title="请输入此验证码，如看不清请点击刷新。"style="cursor:pointer" width="70" height="24" />
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">&nbsp;</th>
                            <td><label>
                                    <input type="button" class="btnSubmit" name="button" value="" onclick="login()"/>
                                </label>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="Bot"></div>
    </div>
    </body>
</html>
