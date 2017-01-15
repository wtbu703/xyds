<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "dict".
 *
 * @property string $id
 * @property string $dictCode
 * @property string $dictName
 * @property string $intro
 * @property string $state
 */
class Dict extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dict';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dictCode' => 'Dict Code',
            'dictName' => 'Dict Name',
            'intro' => 'Intro',
            'state' => 'State',
        ];
    }
}
