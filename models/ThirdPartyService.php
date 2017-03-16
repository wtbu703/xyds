<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "thirdpartyservice".
 *
 * @property string $id
 * @property string $companyName
 * @property string $logoUrl
 * @property string $introduction
 * @property string $tel
 * @property string $email
 * @property string $address
 * @property string $fax
 * @property string $postcode
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
            [['id', 'companyName'], 'required'],
            [['introduction'], 'string'],
            [['id'], 'string', 'max' => 40],
            [['companyName', 'tel', 'email', 'fax'], 'string', 'max' => 16],
            [['logoUrl'], 'string', 'max' => 64],
            [['address'], 'string', 'max' => 32],
            [['postcode'], 'string', 'max' => 6],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '使用函数创建唯一40位ID',
            'companyName' => '公司名',
            'logoUrl' => 'logo图路径',
            'introduction' => '简介',
            'tel' => '电话号码',
            'email' => '电子邮箱',
            'address' => '地址',
            'fax' => '传真',
            'postcode' => '邮编',
        ];
    }
}
