<?php
$this->title = '年表详情';
?>

<div class="pad-lr-10">
    <form id="myform" action="" method="post">
        <div class="pad_10">
            <div style='overflow-y:auto;overflow-x:hidden' class='scrolltable'>
                <table width="100%" cellspacing="0" class="table_form contentWrap">
                    <tr>
                        <th>年份：</th>
                        <td id="year"><?=$countyEconomic->year?>年</td>
                    </tr>
                    <tr>
                        <th >地区生产总值：</th>
                        <td id="GRP"><?=$countyEconomic->GRP?>亿元</td>
                    </tr>
                    <tr>
                        <th>社会消费品零售总额：</th>
                        <td id="socialConsumerTotal"><?=$countyEconomic->socialConsumerTotal?>亿元</td>
                    </tr>
                    <tr>
                        <th>面积：</th>
                        <td id="area"><?=$countyEconomic->area?>平方公里</td>
                    </tr>
                    <tr>
                        <th>乡镇数量：</th>
                        <td id="townNum"><?=$countyEconomic->townNum?>个</td>
                    </tr>
                    <tr>
                        <th>行政村数量：</th>
                        <td id="villageNum"><?=$countyEconomic->villageNum?>个</td>
                    </tr>
                    <tr>
                        <th>常住人口：</th>
                        <td id="permanentPopulation"><?=$countyEconomic->permanentPopulation?>万人</td>
                    </tr>
                    <tr>
                        <th>城镇人口：</th>
                        <td id="urbanPopulation"><?=$countyEconomic->urbanPopulation?>万人</td>
                    </tr>
                    <tr>
                        <th>农村人口：</th>
                        <td id="ruralPopulation"><?=$countyEconomic->ruralPopulation?>万人</td>
                    </tr>
                    <tr>
                        <th>居民人均可支配收入：</th>
                        <td id="disposableIncome"><?=$countyEconomic->disposableIncome?>元</td>
                    </tr>
                    <tr>
                        <th>城镇居民人均可支配收入：</th>
                        <td id="urbanDisposableIncome"><?=$countyEconomic->urbanDisposableIncome?>元</td>
                    </tr>
                    <tr>
                        <th>农村居民人均可支配收入：</th>
                        <td id="ruralDisposableIncome" ><?=$countyEconomic->ruralDisposableIncome?>元</td>
                    </tr>
                    <tr>
                        <th>农村公路里程数：</th>
                        <td id="ruralRoadMileage"><?=$countyEconomic->ruralRoadMileage?>公里</td>
                    </tr>
                    <tr>
                        <th>固定电话年末用户：</th>
                        <td id="telUser"><?=$countyEconomic->telUser?>万户</td>
                    </tr>
                    <tr>
                        <th>移动电话年末用户：</th>
                        <td id="mobileUser"><?=$countyEconomic->mobileUser?>万户</td>
                    </tr>
                    <tr>
                        <th>3G4G移动电话用户：</th>
                        <td id="34GUser"><?=$countyEconomic->siGUser?>万户</td>
                    </tr>
                    <tr>
                        <th>互联网宽带接入用户：</th>
                        <td id="internetAccess"><?=$countyEconomic->internetAccess?>万户</td>
                    </tr>
                    <tr>
                        <th>个体工商户数：</th>
                        <td id="individualHousehold"><?=$countyEconomic->individualHousehold?>家</td>
                    </tr>
                    <tr>
                        <th>注册企业数量：</th>
                        <td id="registeredCompany"><?=$countyEconomic->registeredCompany?>家</td>
                    </tr>
                    <tr>
                        <th>网店数量：</th>
                        <td id="onlineStore" ><?=$countyEconomic->onlineStore?>个</td>
                    </tr>
                    <tr>
                        <th>手机网店、微店数量：</th>
                        <td id="mobileStore"><?=$countyEconomic->mobileStore?>个</td>
                    </tr>
                    <tr>
                        <th>电子商务交易额：</th>
                        <td id="ecTurnover"><?=$countyEconomic->ecTurnover?>万元</td>
                    </tr>
                    <tr>
                        <th>网络零售额：</th>
                        <td id="netRetailSales"><?=$countyEconomic->netRetailSales?>万元</td>
                    </tr>
                </table>
            </div>
            <div class="bk10"></div>

            <div class="table-list">

                <div class="rightbtn">
                    <input type="button" class="buttonclose" name="dosubmit" value="关闭" onclick="window.top.$.dialog.get('economic_detail').close();" />
                </div>
            </div>
    </form>
</div>
