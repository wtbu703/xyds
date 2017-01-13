<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "role_resource".
 *
 * @property string $id
 * @property string $resourceId
 * @property string $roleId
 */
class RoleResource extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'role_resource';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'resourceId', 'roleId'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'resourceId' => 'Resource ID',
            'roleId' => 'Role ID',
        ];
    }
}
