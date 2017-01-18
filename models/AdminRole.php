<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "admin_role".
 *
 * @property string $id
 * @property string $userId
 * @property string $roleId
 */
class AdminRole extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'userId', 'roleId'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userId' => 'User ID',
            'roleId' => 'Role ID',
        ];
    }
}
