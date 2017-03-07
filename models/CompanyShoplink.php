<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "company-shoplink".
 *
 * @property string $id
 * @property string $companyId
 * @property string $shopName
 * @property string $shopLink
 * @property integer $platform
 */
class CompanyShoplink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'companyShoplink';
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
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'companyId' => 'Company ID',
            'shopName' => 'Shop Name',
            'shopLink' => 'Shop Link',
            'platform' => 'Platform',
        ];
    }
}
