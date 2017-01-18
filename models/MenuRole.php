<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "menu_role".
 *
 * @property string $id
 * @property string $menuId
 * @property string $roleId
 */
class MenuRole extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu_role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'menuId', 'roleId'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'menuId' => 'Menu ID',
            'roleId' => 'Role ID',
        ];
    }
}
