<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "thirdpartyservice".
 *
 * @property integer $category
 * @property string $id
 * @property string $companyName
 * @property string $logoUrl
 * @property string $introduction
 * @property string $tel
 * @property string $email
 * @property string $address
 * @property string $fax
 * @property string $postcode
 * @property integer $count
 * @property string $content
 * @property string $sources
 * @property string $datetime
 * @property string $contact
 * @property string $publicTime
 */
class ThirdPartyService extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'thirdpartyservice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category', 'count'], 'integer'],
            [['id', 'companyName'], 'required'],
            [['content'], 'string'],
            [['datetime', 'publicTime'], 'safe'],
            [['id'], 'string', 'max' => 40],
            [['companyName', 'logoUrl', 'introduction', 'address'], 'string', 'max' => 64],
            [['tel', 'fax'], 'string', 'max' => 16],
            [['email', 'sources', 'contact'], 'string', 'max' => 32],
            [['postcode'], 'string', 'max' => 6],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category' => '企业类别',
            'id' => '使用函数创建唯一40位ID',
            'companyName' => '公司名',
            'logoUrl' => 'logo图路径',
            'introduction' => '服务名称',
            'tel' => '电话号码',
            'email' => '电子邮箱',
            'address' => '地址',
            'fax' => '传真',
            'postcode' => '邮编',
            'count' => '点击次数',
            'content' => '服务内容',
            'sources' => '内容来源',
            'datetime' => '更新时间',
            'contact' => '联系人',
            'publicTime' => '发布时间',
        ];
    }
}
