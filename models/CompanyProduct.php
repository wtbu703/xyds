<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "companyproduct".
 *
 * @property string $id
 * @property string $companyId
 * @property string $name
 * @property string $introduction
 * @property double $price
 * @property string $stock
 * @property double $discount
 * @property integer $state
 * @property string $thumbnailUrl
 */
class CompanyProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'companyproduct';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'companyId', 'name'], 'required'],
            [['introduction'], 'string'],
            [['price', 'discount'], 'number'],
            [['stock', 'state'], 'integer'],
            [['id', 'companyId'], 'string', 'max' => 40],
            [['name', 'thumbnailUrl'], 'string', 'max' => 64],
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
            'name' => '产品名',
            'introduction' => '产品介绍',
            'price' => '价格',
            'stock' => '库存',
            'discount' => '折扣',
            'state' => '状态，字典',
            'thumbnailUrl' => 'Thumbnail Url',
        ];
    }
}
