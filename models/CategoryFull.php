<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categoryfull".
 *
 * @property string $id
 * @property string $categoryCode
 * @property string $categoryFullCode
 * @property string $categoryFullName
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
            [['categoryFullCode', 'state'], 'string', 'max' => 4],
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
            'categoryFullCode' => 'Category Full Code',
            'categoryFullName' => 'Category Full Name',
            'orderBy' => 'Order By',
            'state' => 'State',
        ];
    }
}
