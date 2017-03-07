<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "company-product".
 *
 * @property string $id
 * @property string $companyId
 * @property string $name
 * @property string $introduction
 * @property double $price
 * @property string $stock
 * @property double $discount
 * @property integer $state
 */
class CompanyProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'companyProduct';
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
            [['name'], 'string', 'max' => 16],
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
            'name' => 'Name',
            'introduction' => 'Introduction',
            'price' => 'Price',
            'stock' => 'Stock',
            'discount' => 'Discount',
            'state' => 'State',
        ];
    }
}
