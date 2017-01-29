<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categoryfull".
 *
 * @property string $id
 * @property string $categoryCode
 * @property string $categoryFullName
 * @property string $buyCode
 * @property string $sellCode
 * @property integer $orderBy
 * @property string $state
 */
class CategoryFull extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categoryfull';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['orderBy'], 'integer'],
            [['id'], 'string', 'max' => 40],
            [['categoryCode', 'categoryFullName'], 'string', 'max' => 32],
            [['buyCode', 'sellCode', 'state'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'categoryCode' => 'Category Code',
            'categoryFullName' => 'Category Full Name',
            'buyCode' => 'Buy Code',
            'sellCode' => 'Sell Code',
            'orderBy' => 'Order By',
            'state' => 'State',
        ];
    }
}
