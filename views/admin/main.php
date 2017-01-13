<?php

use yii\helpers\Html;
use app\assets\AppAsset;

AppAsset::register($this);

?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?><!--生成一个替换字符，表示css和js的引用代码在这里显示-->
        <style>
            html,body {
                padding:0;
                margin:0;
                overflow-x: hidden;
                overflow-y: auto;
            }
        </style>
    </head>
    <body>

    </body>
</html>

