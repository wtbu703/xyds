<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pic".
 *
 * @property string $id
 * @property string $picCode
 * @property string $picName
 * @property string $intro
 * @property string $state
 */
class Pic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'string', 'max' => 40],
            [['picCode', 'picName'], 'string', 'max' => 32],
            [['intro'], 'string', 'max' => 128],
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
            'picName' => 'Pic Name',
            'intro' => 'Intro',
            'state' => 'State',
        ];
    }
}
