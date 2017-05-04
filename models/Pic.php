<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pic".
 *
 * @property string $id
 * @property integer $category
 * @property string $url
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
            [['category'], 'integer'],
            [['id'], 'string', 'max' => 40],
            [['url'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category' => '图片类别',
            'url' => '图片路径',
        ];
    }
}
