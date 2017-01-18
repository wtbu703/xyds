<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "video".
 *
 * @property string $id
 * @property string $name
 * @property string $source
 * @property string $url
 * @property string $datetime
 * @property integer $sign
 * @property integer $state
 */
class Video extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'video';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['datetime'], 'safe'],
            [['sign', 'state'], 'integer'],
            [['id', 'name'], 'string', 'max' => 32],
            [['source'], 'string', 'max' => 64],
            [['url'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'source' => 'Source',
            'url' => 'Url',
            'datetime' => 'Datetime',
            'sign' => 'Sign',
            'state' => 'State',
        ];
    }
}
