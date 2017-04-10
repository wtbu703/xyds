<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "infostate".
 *
 * @property string $id
 * @property string $infoId
 * @property integer $state
 * @property string $time
 */
class InfoState extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'infostate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['state'], 'integer'],
            [['time'], 'safe'],
            [['id', 'infoId'], 'string', 'max' => 40],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'infoId' => 'Info ID',
            'state' => '招标状态',
            'time' => 'Time',
        ];
    }
}
