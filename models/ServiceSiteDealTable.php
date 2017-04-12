<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "servicesitedealtable".
 *
 * @property string $id
 * @property string $siteId
 * @property string $date
 * @property integer $buyGoodCategory
 * @property double $buyMoneySum
 * @property string $buyOrderTotal
 * @property integer $sellGoodCategory
 * @property double $sellMoneySum
 * @property string $sellOrderTotal
 * @property string $state
 */
class Servicesitedealtable extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'servicesitedealtable';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'siteId', 'date', 'buyGoodCategory', 'buyMoneySum', 'buyOrderTotal', 'sellGoodCategory', 'sellMoneySum', 'sellOrderTotal'], 'required'],
            [['date'], 'safe'],
            [['buyGoodCategory', 'buyOrderTotal', 'sellGoodCategory', 'sellOrderTotal'], 'integer'],
            [['buyMoneySum', 'sellMoneySum'], 'number'],
            [['id', 'siteId'], 'string', 'max' => 40],
            [['state'], 'string', 'max' => 2],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'siteId' => '站点ID，外键，使用函数创建唯一40位ID',
            'date' => '日期',
            'buyGoodCategory' => '代买商品类别，从XML读取，分号分隔',
            'buyMoneySum' => '代买总金额，分号分隔',
            'buyOrderTotal' => '代买订单数',
            'sellGoodCategory' => '销售商品类别，从XML读取，分号分隔',
            'sellMoneySum' => '销售总金额，分号分隔',
            'sellOrderTotal' => '销售订单数',
            'state' => 'State',
        ];
    }
}
