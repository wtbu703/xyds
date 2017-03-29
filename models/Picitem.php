<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "picitem".
 *
 * @property string $id
 * @property string $picCode
 * @property string $picUrl
 * @property integer $orderBy
 * @property string $state
 */
class Picitem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'picitem';
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
            [['picCode'], 'string', 'max' => 32],
            [['picUrl'], 'string', 'max' => 128],
            [['state'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'picCode' => 'Pic Code',
            'picUrl' => 'Pic Url',
            'orderBy' => 'Order By',
            'state' => 'State',
        ];
    }
}
