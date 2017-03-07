<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "county-economic".
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
 * @property double $34GUser
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
        return 'countyEconomic';
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
            'id' => 'ID',
            'GRP' => 'Grp',
            'socialConsumerTotal' => 'Social Consumer Total',
            'area' => 'Area',
            'townNum' => 'Town Num',
            'villageNum' => 'Village Num',
            'permanentPopulation' => 'Permanent Population',
            'urbanPopulation' => 'Urban Population',
            'ruralPopulation' => 'Rural Population',
            'disposableIncome' => 'Disposable Income',
            'urbanDisposableIncome' => 'Urban Disposable Income',
            'ruralDisposableIncome' => 'Rural Disposable Income',
            'ruralRoadMileage' => 'Rural Road Mileage',
            'telUser' => 'Tel User',
            'mobileUser' => 'Mobile User',
            'siGUser' => 'si Guser',
            'internetAccess' => 'Internet Access',
            'individualHousehold' => 'Individual Household',
            'registeredCompany' => 'Registered Company',
            'onlineStore' => 'Online Store',
            'mobileStore' => 'Mobile Store',
            'ecTurnover' => 'Ec Turnover',
            'netRetailSales' => 'Net Retail Sales',
            'year' => 'Year',
        ];
    }
}
