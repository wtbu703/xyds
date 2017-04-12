<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "countyeconomic".
 *
 * @property string $id
 * @property double $GRP
 * @property double $socialConsumerTotal
 * @property double $area
 * @property string $townNum
 * @property string $villageNum
 * @property double $permanentPopulation
 * @property double $urbanPopulation
 * @property double $ruralPopulation
 * @property double $disposableIncome
 * @property double $urbanDisposableIncome
 * @property double $ruralDisposableIncome
 * @property double $ruralRoadMileage
 * @property double $telUser
 * @property double $mobileUser
 * @property double $siGUser
 * @property double $internetAccess
 * @property string $individualHousehold
 * @property string $registeredCompany
 * @property string $onlineStore
 * @property string $mobileStore
 * @property double $ecTurnover
 * @property double $netRetailSales
 * @property string $year
 */
class CountyEconomic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'countyeconomic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['GRP', 'socialConsumerTotal', 'area', 'permanentPopulation', 'urbanPopulation', 'ruralPopulation', 'disposableIncome', 'urbanDisposableIncome', 'ruralDisposableIncome', 'ruralRoadMileage', 'telUser', 'mobileUser', 'siGUser', 'internetAccess', 'ecTurnover', 'netRetailSales'], 'number'],
            [['townNum', 'villageNum', 'individualHousehold', 'registeredCompany', 'onlineStore', 'mobileStore'], 'integer'],
            [['year'], 'safe'],
            [['id'], 'string', 'max' => 40],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '使用函数创建唯一40位ID',
            'GRP' => '地区生产总值，单位亿元',
            'socialConsumerTotal' => '社会消费品零售总额，单位亿元',
            'area' => '面积，单位平方公里',
            'townNum' => '乡镇数量',
            'villageNum' => '行政村数量',
            'permanentPopulation' => '常住人口，单位万人',
            'urbanPopulation' => '城镇人口，单位万人',
            'ruralPopulation' => '农村人口，单位万人',
            'disposableIncome' => '居民人均可支配收入，单位元',
            'urbanDisposableIncome' => '城镇居民人均可支配收入，单位元',
            'ruralDisposableIncome' => '农村居民人均可支配收入，单位元',
            'ruralRoadMileage' => '农村公路里程数',
            'telUser' => '固定电话年末用户，单位万户',
            'mobileUser' => '移动电话年末用户，单位万人',
            'siGUser' => '3G4G移动电话用户，单位万户',
            'internetAccess' => '互联网宽带接入用户，单位万户',
            'individualHousehold' => '个体工商户数，单位家',
            'registeredCompany' => '注册企业数量（企业法人单位数）',
            'onlineStore' => '网店数量，单位个',
            'mobileStore' => '手机网店，微店数量，单位个',
            'ecTurnover' => '电子商务交易额，单位万元',
            'netRetailSales' => '网络零售额，单位万元',
            'year' => 'Year',
        ];
    }
}
