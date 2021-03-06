<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dailysheet".
 *
 * @property string $id
 * @property string $siteId
 * @property string $dealId
 * @property string $code
 * @property string $name
 * @property string $countyType
 * @property string $buyGoodCategory
 * @property string $buyMoneySum
 * @property string $buyOrderTotal
 * @property string $sellGoodCategory
 * @property string $sellMoneySum
 * @property string $sellOrderTotal
 * @property string $date
 * @property string $state
 */
class DailySheet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dailysheet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['siteId', 'dealId', 'code', 'name', 'countyType', 'buyGoodCategory', 'buyMoneySum', 'buyOrderTotal', 'sellGoodCategory', 'sellMoneySum', 'sellOrderTotal'], 'string'],
            [['date'], 'safe'],
            [['id'], 'string', 'max' => 40],
            [['state'], 'string', 'max' => 2],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '使用函数创建唯一40位ID',
            'siteId' => '外键，站点ID，使用函数创建唯一40位ID',
            'dealId' => '交易信息ID，外键，使用函数创建唯一40位ID',
            'code' => '站点编码',
            'name' => '站点名称',
            'countyType' => '站点类型，字典',
            'buyGoodCategory' => '代买商品类别，从XML读取，分号分隔',
            'buyMoneySum' => '代买总金额，分号分隔',
            'buyOrderTotal' => '代买总订单数',
            'sellGoodCategory' => '销售商品类别，从XML读取，分号分隔',
            'sellMoneySum' => '销售总金额，分号分隔',
            'sellOrderTotal' => '销售总订单数',
            'date' => '日期',
            'state' => 'State',
        ];
    }
}
