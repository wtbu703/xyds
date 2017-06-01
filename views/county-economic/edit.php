<?php
$this->title = "修改年表";
?>
<?php
$this->title = '添加年表';
?>
<script language="javascript" type="text/javascript">
    window.onload=function(){
//设置年份的选择
        var myDate= new Date();
        var startYear=myDate.getFullYear()-50;//起始年份
        var endYear=myDate.getFullYear()+50;//结束年份
        var obj=document.getElementById('year')
        for (var i=startYear;i<=endYear;i++)
        {
            obj.options.add(new Option(i,i));
        }
        //obj.options[obj.options.length-51].selected=1;
    }
</script>
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
                    <table width="100%" cellspacing="0" class="table_form contentWrap">
                        <tbody>
                        <tr>
                            <th align="right" width="140px"><sub class="redstar">*</sub>年份：</th>
                            <td><select id="year" style="width:200px;height:25px;" >
                                    <option name="period" value="<?=$countyEconomic->year?>" selected><?=$countyEconomic->year?></option>
                                </select>年</td>
                            <td><div id="yearTip"></div></td>
                            <input type="hidden"  name="id" id="id" style="width:250px;" value="<?=$countyEconomic->id?>" />
                        </tr>
                        <tr>
                            <th  align="right"><sub class="redstar">*</sub>地区生产总值：</th>
                            <td><input type="text" style="width:250px;" name="GRP" id="GRP" onkeyup="this.value=this.value.replace(/[^0-9-.-]+/,'');" value="<?=$countyEconomic->GRP?>"  class="input-text"/>亿元</td>
                            <td><div id="GRPTip"></div></td>
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>社会消费品零售总额：</th>
                            <td><input type="text" style="width:250px;" name="socialConsumerTotal" onkeyup="this.value=this.value.replace(/[^0-9-.-]+/,'');" id="socialConsumerTotal" value="<?=$countyEconomic->socialConsumerTotal?>" class="input-text"/>亿元</td>
                            <td><div id="socialConsumerTotalTip"></div></td>
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>面积：</th>
                            <td><input type="text" style="width:250px;" name="area" id="area" onkeyup="this.value=this.value.replace(/[^0-9-.-]+/,'');" value="<?=$countyEconomic->area?>" class="input-text"/>平方公里</td>
                            <td><div id="areaTip"></div></td>
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>乡镇数量：</th>
                            <td><input type="text" style="width:250px;"   name="townNum" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');" id="townNum"  value="<?=$countyEconomic->townNum?>" class="input-text"/>个</td>
                            <td><div id="townNumTip"></div></td>
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>行政村数量：</th>
                            <td><input type="text" style="width:250px;"   name="villageNum" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');" id="villageNum" value="<?=$countyEconomic->villageNum?>"  class="input-text"/>个</td>
                            <td><div id="villageNumTip"></div></td>
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>常住人口：</th>
                            <td><input type="text" style="width:250px;" name="permanentPopulation" onkeyup="this.value=this.value.replace(/[^0-9-.-]+/,'');" id="permanentPopulation" value="<?=$countyEconomic->permanentPopulation?>"  class="input-text"/>万人</td>
                            <td><div id="permanentPopulationTip"></div></td>
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>城镇人口：</th>
                            <td><input type="text" style="width:250px;" name="urbanPopulation" id="urbanPopulation" value="<?=$countyEconomic->urbanPopulation?>" onkeyup="this.value=this.value.replace(/[^0-9-.-]+/,'');"  class="input-text"/>万人</td>
                            <td><div id="urbanPopulationTip"></div></td>
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>农村人口：</th>
                            <td><input type="text" style="width:250px;" name="ruralPopulation" id="ruralPopulation" value="<?=$countyEconomic->ruralPopulation?>" onkeyup="this.value=this.value.replace(/[^0-9-.-]+/,'');" class="input-text"/>万人</td>
                            <td><div id="ruralPopulationTip"></div></td>
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>居民人均可支配收入：</th>
                            <td><input type="text" style="width:250px;" name="disposableIncome" id="disposableIncome" value="<?=$countyEconomic->disposableIncome?>" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');" class="input-text"/>元</td>
                            <td><div id="disposableIncomeTip"></div></td>
                        </tr>
                        <tr>
                            <th width="170" align="right"><sub class="redstar">*</sub>城镇居民人均可支配收入：</th>
                            <td><input type="text" style="width:250px;" name="urbanDisposableIncome" id="urbanDisposableIncome" value="<?=$countyEconomic->urbanDisposableIncome?>" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');"  class="input-text"/>元</td>
                            <td><div id="urbanDisposableIncomeTip"></div></td>
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>农村居民人均可支配收入：</th>
                            <td><input type="text" style="width:250px;" name="ruralDisposableIncome" id="ruralDisposableIncome" value="<?=$countyEconomic->ruralDisposableIncome?>" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');" class="input-text"/>元</td>
                            <td><div id="ruralDisposableIncomeTip"></div></td>
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>农村公路里程数：</th>
                            <td><input type="text" style="width:250px;" name="ruralRoadMileage" id="ruralRoadMileage" value="<?=$countyEconomic->ruralRoadMileage?>" onkeyup="this.value=this.value.replace(/[^0-9-.-]+/,'');"  class="input-text"/>公里</td>
                            <td><div id="ruralRoadMileageTip"></div></td>
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>固定电话年末用户：</th>
                            <td><input type="text" style="width:250px;" name="telUser" id="telUser" value="<?=$countyEconomic->telUser?>" onkeyup="this.value=this.value.replace(/[^0-9-.-]+/,'');"  class="input-text"/>万户</td>
                            <td><div id="telUserTip"></div></td>
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>移动电话年末用户：</th>
                            <td><input type="text" style="width:250px;" name="mobileUser" id="mobileUser" value="<?=$countyEconomic->mobileUser?>" onkeyup="this.value=this.value.replace(/[^0-9-.-]+/,'');"  class="input-text"/>万户</td>
                            <td><div id="mobileUserTip"></div></td >
                        </tr>
                        <tr>
                            <th align="right">3<sub class="redstar">*</sub>G4G移动电话用户：</th>
                            <td><input type="text" style="width:250px;" name="34GUser" id="34GUser" value="<?=$countyEconomic->siGUser?>" onkeyup="this.value=this.value.replace(/[^0-9-.-]+/,'');" class="input-text"/>万户</td>
                            <td><div id="34GUserTip"></div></td >
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>互联网宽带接入用户：</th>
                            <td><input type="text" style="width:250px;" name="internetAccess" id="internetAccess" value="<?=$countyEconomic->internetAccess?>" onkeyup="this.value=this.value.replace(/[^0-9-.-]+/,'');" class="input-text"/>万户</td>
                            <td><div id="internetAccessTip"></div></td >
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>个体工商户数：</th>
                            <td><input type="text" style="width:250px;"  name="individualHousehold" id="individualHousehold" value="<?=$countyEconomic->individualHousehold?>" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');"  class="input-text"/>家</td>
                            <td><div id="individualHouseholdTip"></div></td >
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>注册企业数量：</th>
                            <td><input type="text" style="width:250px;"  name="registeredCompany" id="registeredCompany" value="<?=$countyEconomic->registeredCompany?>" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');" class="input-text"/>家</td>
                            <td><div id="registeredCompanyTip"></div></td >
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>网店数量：</th>
                            <td><input type="text" style="width:250px;"  name="onlineStore" id="onlineStore" value="<?=$countyEconomic->onlineStore?>" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');" class="input-text"/>个</td>
                            <td><div id="onlineStoreTip"></div></td >
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>手机网店、微店数量：</th>
                            <td><input type="text" style="width:250px;"  name="mobileStore" id="mobileStore" value="<?=$countyEconomic->mobileStore?>"  onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');" class="input-text"/>个</td>
                            <td><div id="mobileStoreTip"></div></td >
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>电子商务交易额：</th>
                            <td><input type="text" style="width:250px;" name="ecTurnover" id="ecTurnover"  value="<?=$countyEconomic->ecTurnover?>" onkeyup="this.value=this.value.replace(/[^0-9-.-]+/,'');" class="input-text"/>万元</td>
                            <td><div id="ecTurnoverTip"></div></td >
                        </tr>
                        <tr>
                            <th align="right"><sub class="redstar">*</sub>网络零售额：</th>
                            <td><input type="text" style="width:250px;" name="netRetailSales" id="netRetailSales" value="<?=$countyEconomic->netRetailSales?>" onkeyup="this.value=this.value.replace(/[^0-9-.-]+/,'');"  class="input-text"/>万元</td>
                            <td><div id="netRetailSalesTip"></div></td >
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
