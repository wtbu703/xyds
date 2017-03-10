<?php
$this->title = "修改年表";
?>
<script>
    var updateUrl = "<?=yii::$app->urlManager->createUrl('county-economic/update-one')?>";
</script>
<script language="javascript" type="text/javascript" src="js/admin/county-economic/edit.js" charset="utf-8"></script>

<div class="pad-lr-10">
<form name="myform" action="" method="post" id="myform" target="center_frame">
    <div class="pad-10">
        <div class="col-tab">
            <ul class="tabBut cu-li">
                <li id="tab_setting_1" class="on" onclick="">修改年表</li>
            </ul>
            <div id="div_setting_1" class="contentList pad-10">
                <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                    <table width="90%" cellspacing="0" class="table_form contentWrap">
                        <tbody>
                        <tr>
                            <th>年份：</th>
                            <td><input type="text" style="width:250px;" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');"  name="year" id="year"  class="input-text" value="<?=$countyEconomic->year?>" />年</td>
                            <input type="hidden"  name="id" id="id" style="width:250px;" value="<?=$countyEconomic->id?>" />
                        </tr>
                        <tr>
                            <th >地区生产总值：</th>
                            <td><input type="text" style="width:250px;" name="GRP" id="GRP" value="<?=$countyEconomic->GRP?>"  class="input-text"/>亿元</td>
                        </tr>
                        <tr>
                            <th>社会消费品零售总额：</th>
                            <td><input type="text" style="width:250px;" name="socialConsumerTotal" id="socialConsumerTotal" value="<?=$countyEconomic->socialConsumerTotal?>"  class="input-text"/>亿元</td>
                        </tr>
                        <tr>
                            <th>面积：</th>
                            <td><input type="text" style="width:250px;" name="area" id="area" value="<?=$countyEconomic->area?>" class="input-text"/>平方公里</td>
                        </tr>
                        <tr>
                            <th>乡镇数量：</th>
                            <td><input type="text" style="width:250px;" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');"  name="townNum" id="townNum"  value="<?=$countyEconomic->townNum?>"  class="input-text"/>个</td>
                        </tr>
                        <tr>
                            <th>行政村数量：</th>
                            <td><input type="text" style="width:250px;" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');"  name="villageNum" id="villageNum" value="<?=$countyEconomic->villageNum?>"  class="input-text"/>个</td>
                        </tr>
                        <tr>
                            <th>常住人口：</th>
                            <td><input type="text" style="width:250px;" name="permanentPopulation" id="permanentPopulation" value="<?=$countyEconomic->permanentPopulation?>"  class="input-text"/>万人</td>
                        </tr>
                        <tr>
                            <th>城镇人口：</th>
                            <td><input type="text" style="width:250px;" name="urbanPopulation" id="urbanPopulation" value="<?=$countyEconomic->urbanPopulation?>" class="input-text"/>万人</td>
                        </tr>
                        <tr>
                            <th>农村人口：</th>
                            <td><input type="text" style="width:250px;" name="ruralPopulation" id="ruralPopulation" value="<?=$countyEconomic->ruralPopulation?>" class="input-text"/>万人</td>
                        </tr>
                        <tr>
                            <th>居民人均可支配收入：</th>
                            <td><input type="text" style="width:250px;" name="disposableIncome" id="disposableIncome" value="<?=$countyEconomic->disposableIncome?>" class="input-text"/>元</td>
                        </tr>
                        <tr>
                            <th>城镇居民人均可支配收入：</th>
                            <td><input type="text" style="width:250px;" name="urbanDisposableIncome" id="urbanDisposableIncome" value="<?=$countyEconomic->urbanDisposableIncome?>"  class="input-text"/>元</td>
                        </tr>
                        <tr>
                            <th>农村居民人均可支配收入：</th>
                            <td><input type="text" style="width:250px;" name="ruralDisposableIncome" id="ruralDisposableIncome" value="<?=$countyEconomic->ruralDisposableIncome?>" class="input-text"/>元</td>
                        </tr>
                        <tr>
                            <th>农村公路里程数：</th>
                            <td><input type="text" style="width:250px;" name="ruralRoadMileage" id="ruralRoadMileage" value="<?=$countyEconomic->ruralRoadMileage?>"  class="input-text"/>公里</td>
                        </tr>
                        <tr>
                            <th>固定电话年末用户：</th>
                            <td><input type="text" style="width:250px;" name="telUser" id="telUser" value="<?=$countyEconomic->telUser?>"  class="input-text"/>万户</td>
                        </tr>
                        <tr>
                            <th>移动电话年末用户：</th>
                            <td><input type="text" style="width:250px;" name="mobileUser" id="mobileUser" value="<?=$countyEconomic->mobileUser?>" class="input-text"/>万户</td>
                        </tr>
                        <tr>
                            <th>3G4G移动电话用户：</th>
                            <td><input type="text" style="width:250px;" name="34GUser" id="34GUser" value="<?=$countyEconomic->siGUser?>" class="input-text"/>万户</td>
                        </tr>
                        <tr>
                            <th>互联网宽带接入用户：</th>
                            <td><input type="text" style="width:250px;" name="internetAccess" id="internetAccess" value="<?=$countyEconomic->internetAccess?>" class="input-text"/>万户</td>
                        </tr>
                        <tr>
                            <th>个体工商户数：</th>
                            <td><input type="text" style="width:250px;" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');"  name="individualHousehold" id="individualHousehold"value="<?=$countyEconomic->individualHousehold?>" class="input-text"/>家</td>
                        </tr>
                        <tr>
                            <th>注册企业数量：</th>
                            <td><input type="text" style="width:250px;" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');"  name="registeredCompany" id="registeredCompany" value="<?=$countyEconomic->registeredCompany?>"  class="input-text"/>家</td>
                        </tr>
                        <tr>
                            <th>网店数量：</th>
                            <td><input type="text" style="width:250px;" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');"  name="onlineStore" id="onlineStore" value="<?=$countyEconomic->onlineStore?>" class="input-text"/>个</td>
                        </tr>
                        <tr>
                            <th>手机网店、微店数量：</th>
                            <td><input type="text" style="width:250px;" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');"  name="mobileStore" id="mobileStore" value="<?=$countyEconomic->mobileStore?>" class="input-text"/>个</td>
                        </tr>
                        <tr>
                            <th>电子商务交易额：</th>
                            <td><input type="text" style="width:250px;" name="ecTurnover" id="ecTurnover"  value="<?=$countyEconomic->ecTurnover?>" class="input-text"/>万元</td>
                        </tr>
                        <tr>
                            <th>网络零售额：</th>
                            <td><input type="text" style="width:250px;" name="netRetailSales" id="netRetailSales" value="<?=$countyEconomic->netRetailSales?>"  class="input-text"/>万元</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="bk10"></div>
                <div class="rightbtn">
                    <input type="button" class="buttonconfirm" id="dosubmits" name="dosubmits" value="保存" onclick="edit()"/>
                    &nbsp;&nbsp;<input type="button" class="buttondel" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('economic_update').close();"/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div>
        </div>
    </div>
</form>
</div>
