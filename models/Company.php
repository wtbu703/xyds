<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property string $id
 * @property string $name
 * @property string $logoUrl
 * @property string $introduction
 * @property string $tel
 * @property string $address
 * @property string $corporate
 * @property string $sources
 * @property integer $count
 * @property string $datetime
 * @property string $webSite
 * @property integer $category
 */
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
            [['count', 'category'], 'integer'],
            [['datetime'], 'safe'],
            [['id'], 'string', 'max' => 40],
            [['name', 'tel'], 'string', 'max' => 16],
            [['logoUrl', 'webSite'], 'string', 'max' => 64],
            [['address'], 'string', 'max' => 32],
            [['corporate', 'sources'], 'string', 'max' => 8],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '使用函数创建唯一40位ID',
            'name' => '企业名',
            'logoUrl' => 'logo路径',
            'introduction' => '简介',
            'tel' => '联系电话',
            'address' => '地址',
            'corporate' => '法人',
            'sources' => 'Sources',
            'count' => 'Count',
            'datetime' => 'Datetime',
            'webSite' => 'Web Site',
            'category' => 'Category',
        ];
    }
}
