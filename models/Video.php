<?php

namespace app\models;

use Yii;

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
 * @property string $picUrl
 * @property string $content
 * @property string $duration
 */
class Video extends \yii\db\ActiveRecord
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
            [['content'], 'string'],
            [['id', 'name'], 'string', 'max' => 32],
            [['source', 'picUrl'], 'string', 'max' => 64],
            [['url'], 'string', 'max' => 128],
            [['duration'], 'string', 'max' => 255],
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
            'picUrl' => 'Pic Url',
            'content' => 'Content',
            'duration' => 'Duration',
        ];
    }
}
