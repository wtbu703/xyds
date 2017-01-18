<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "servicesite".
 *
 * @property string $id
 * @property string $code
 * @property string $name
 * @property integer $countyType
 */
class ServiceSite extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'servicesite';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'code', 'name', 'countyType'], 'required'],
            [['countyType'], 'integer'],
            [['id'], 'string', 'max' => 40],
            [['code', 'name'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '使用函数创建唯一40位ID',
            'code' => '站点编码，固定',
            'name' => '站点名称，不可更改',
            'countyType' => '站点类型，字典',
        ];
    }
}
