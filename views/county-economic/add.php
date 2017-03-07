<?php
$this->title = '添加年表';
?>

<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript">
    var listallUrl = "<?=yii::$app->urlManager->createUrl('county-economic/find-by-attri')?>";
    var insertUrl = "<?=yii::$app->urlManager->createUrl('county-economic/add-one')?>";
</script>
<script type="text/javascript" src="js/admin/county-economic/add.js"></script>
</head>
<body>
    <div class="pad-lr-10">
        <form name="myform" action="" method="post" id="myform" target="iframeId">
            <div class="pad_10">
                <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                    <table width="100%" cellspacing="0" class="table_form contentWrap">
                        <tr>
                            <th>年份：</th>
                            <td><input type="text" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');"  style="width:250px;" name="year" id="year"  class="input-text"/>年</td>
                        </tr>
                        <tr>
                            <th >地区生产总值：</th>
                            <td><input type="text" style="width:250px;"  name="GRP" id="GRP"  class="input-text"/>亿元</td>
                        </tr>
                        <tr>
                            <th>社会消费品零售总额：</th>
                            <td><input type="text" style="width:250px;" name="socialConsumerTotal" id="socialConsumerTotal"  class="input-text"/>亿元</td>
                        </tr>
                        <tr>
                            <th>面积：</th>
                            <td><input type="text" style="width:250px;" name="area" id="area"  class="input-text"/>平方公里</td>
                        </tr>
                        <tr>
                            <th>乡镇数量：</th>
                            <td><input type="text" style="width:250px;" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');"  name="townNum" id="townNum"  class="input-text"/>个</td>
                        </tr>
                        <tr>
                            <th>行政村数量：</th>
                            <td><input type="text" style="width:250px;" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');"  name="villageNum" id="villageNum"  class="input-text"/>个</td>
                        </tr>
                        <tr>
                            <th>常住人口：</th>
                            <td><input type="text" style="width:250px;" name="permanentPopulation" id="permanentPopulation"  class="input-text"/>万人</td>
                        </tr>
                        <tr>
                            <th>城镇人口：</th>
                            <td><input type="text" style="width:250px;" name="urbanPopulation" id="urbanPopulation"  class="input-text"/>万人</td>
                        </tr>
                        <tr>
                            <th>农村人口：</th>
                            <td><input type="text" style="width:250px;" name="ruralPopulation" id="ruralPopulation"  class="input-text"/>万人</td>
                        </tr>
                        <tr>
                            <th>居民人均可支配收入：</th>
                            <td><input type="text" style="width:250px;" name="disposableIncome" id="disposableIncome"  class="input-text"/>元</td>
                        </tr>
                        <tr>
                            <th>城镇居民人均可支配收入：</th>
                            <td><input type="text" style="width:250px;" name="urbanDisposableIncome" id="urbanDisposableIncome"  class="input-text"/>元</td>
                        </tr>
                        <tr>
                            <th>农村居民人均可支配收入：</th>
                            <td><input type="text" style="width:250px;" name="ruralDisposableIncome" id="ruralDisposableIncome"  class="input-text"/>元</td>
                        </tr>
                        <tr>
                            <th>农村公路里程数：</th>
                            <td><input type="text" style="width:250px;" name="ruralRoadMileage" id="ruralRoadMileage"  class="input-text"/>公里</td>
                        </tr>
                        <tr>
                            <th>固定电话年末用户：</th>
                            <td><input type="text" style="width:250px;" name="telUser" id="telUser"  class="input-text"/>万户</td>
                        </tr>
                        <tr>
                            <th>移动电话年末用户：</th>
                            <td><input type="text" style="width:250px;" name="mobileUser" id="mobileUser"  class="input-text"/>万户</td>
                        </tr>
                        <tr>
                            <th>3G4G移动电话用户：</th>
                            <td><input type="text" style="width:250px;" name="34GUser" id="34GUser"  class="input-text"/>万户</td>
                        </tr>
                        <tr>
                            <th>互联网宽带接入用户：</th>
                            <td><input type="text" style="width:250px;" name="internetAccess" id="internetAccess"  class="input-text"/>万户</td>
                        </tr>
                        <tr>
                            <th>个体工商户数：</th>
                            <td><input type="text" style="width:250px;" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');"  name="individualHousehold" id="individualHousehold"  class="input-text"/>家</td>
                        </tr>
                        <tr>
                            <th>注册企业数量：</th>
                            <td><input type="text" style="width:250px;" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');"  name="registeredCompany" id="registeredCompany"  class="input-text"/>家</td>
                        </tr>
                        <tr>
                            <th>网店数量：</th>
                            <td><input type="text" style="width:250px;" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');"  name="onlineStore" id="onlineStore"  class="input-text"/>个</td>
                        </tr>
                        <tr>
                            <th>手机网店、微店数量：</th>
                            <td><input type="text" style="width:250px;" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');"  name="mobileStore" id="mobileStore"  class="input-text"/>个</td>
                        </tr>
                        <tr>
                            <th>电子商务交易额：</th>
                            <td><input type="text" style="width:250px;" name="ecTurnover" id="ecTurnover"  class="input-text"/>万元</td>
                        </tr>
                        <tr>
                            <th>网络零售额：</th>
                            <td><input type="text" style="width:250px;" name="netRetailSales" id="netRetailSales"  class="input-text"/>万元</td>
                        </tr>
                    </table>
                </div>
                <div class="bk10"></div>
            </div>
        </form>
        <div class="table-list">
            <div class="rightbtn">
                <input type="button" class="buttonsave" value="增加" name="dosubmit" onclick="add()" />
                <input type="button" class="buttonclose" value="关闭" name="dosubmit"  onclick="window.top.$.dialog.get('economic_add').close();"/>
            </div>
        </div>
        </br>
        </br>
    </div>
</body>
</html>
