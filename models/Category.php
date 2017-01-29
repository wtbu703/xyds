<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property string $id
 * @property string $categoryCode
 * @property string $categoryName
 * @property string $intro
 * @property string $state
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'string', 'max' => 40],
            [['categoryCode', 'categoryName'], 'string', 'max' => 32],
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
            'categoryCode' => 'Category Code',
            'categoryName' => 'Category Name',
            'intro' => 'Intro',
            'state' => 'State',
        ];
    }
}
