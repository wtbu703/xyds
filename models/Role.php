<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "role".
 *
 * @property string $id
 * @property string $name
 * @property string $state
 */
class Role extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'name'], 'string', 'max' => 32],
            [['state'], 'string', 'max' => 4]
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
            'state' => 'State',
        ];
    }
}
