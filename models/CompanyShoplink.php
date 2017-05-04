<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "companyshoplink".
 *
 * @property string $id
 * @property string $companyId
 * @property string $shopName
 * @property string $shopLink
 * @property integer $platform
 * @property string $companyName
 */
class CompanyShoplink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'companyshoplink';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'companyId', 'shopName', 'platform'], 'required'],
            [['platform'], 'integer'],
            [['id', 'companyId'], 'string', 'max' => 40],
            [['shopName'], 'string', 'max' => 16],
            [['shopLink'], 'string', 'max' => 64],
            [['companyName'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '使用函数创建唯一40位ID',
            'companyId' => '企业ID，外键，使用函数创建唯一40位ID',
            'shopName' => '网店名',
            'shopLink' => '网店链接',
            'platform' => '网店所在平台，字典',
            'companyName' => '企业名称',
        ];
    }
}
