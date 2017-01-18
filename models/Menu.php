<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "menu".
 *
 * @property string $id
 * @property string $menuName
 * @property string $menuUrl
 * @property string $state
 * @property integer $olderBy
 * @property string $upLevelMenu
 * @property string $menuLevel
 * @property array|mixed orderBy
 */
class Menu extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['orderBy'], 'integer'],
            [['id', 'state', 'upLevelMenu'], 'string', 'max' => 32],
            [['menuName'], 'string', 'max' => 16],
            [['menuUrl'], 'string', 'max' => 64],
            [['menuLevel'], 'string', 'max' => 4]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '菜单表ID',
            'menuName' => '菜单名称',
            'menuUrl' => 'Menu Url',
            'state' => 'State',
            'orderBy' => '菜单编码001000后面三个零表示一级菜单001001表示该级菜单下的二级 菜单',
            'upLevelMenu' => 'Uplevel Menu',
            'menuLevel' => 'Menu Level',
        ];
    }
}
