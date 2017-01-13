<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resource".
 *
 * @property string $id
 * @property string $tableName
 * @property string $tableOpreate
 * @property string $note
 */
class Resource extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'resource';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'tableName', 'tableOpreate'], 'string', 'max' => 32],
            [['note'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tableName' => 'Table Name',
            'tableOpreate' => 'Table Opreate',
            'note' => 'Note',
        ];
    }
}
