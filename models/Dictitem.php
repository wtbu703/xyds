<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "dictitem".
 *
 * @property string $id
 * @property string $dictCode
 * @property string $dictItemCode
 * @property string $dictItemName
 * @property integer $orderBy
 * @property string $state
 */
class Dictitem extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dictitem';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['orderBy'], 'integer'],
            [['id', 'dictCode', 'dictItemName'], 'string', 'max' => 32],
            [['dictItemCode', 'state'], 'string', 'max' => 4]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dictCode' => 'Dict Code',
            'dictItemCode' => 'Dict Item Code',
            'dictItemName' => 'Dict Item Name',
            'orderBy' => 'Order By',
            'state' => 'State',
        ];
    }
}
