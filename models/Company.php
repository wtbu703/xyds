<?php

namespace app\models;

use Yii;


class Company extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name'], 'required'],
            [['introduction'], 'string'],
            [['id'], 'string', 'max' => 40],
            [['name', 'tel'], 'string', 'max' => 16],
            [['logoUrl'], 'string', 'max' => 64],
            [['address'], 'string', 'max' => 32],
            [['corporate'], 'string', 'max' => 8],
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
            'logoUrl' => 'Logo Url',
            'introduction' => 'Introduction',
            'tel' => 'Tel',
            'address' => 'Address',
            'corporate' => 'Corporate',
        ];
    }
}
