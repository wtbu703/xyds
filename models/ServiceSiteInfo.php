<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "servicesiteinfo".
 *
 * @property string $id
 * @property string $siteId
 * @property string $chargeName
 * @property string $chargeMobile
 * @property string $address
 * @property string $picUrl
 */
class ServiceSiteInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'servicesiteinfo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'siteId'], 'string', 'max' => 40],
            [['chargeName'], 'string', 'max' => 8],
            [['chargeMobile'], 'string', 'max' => 11],
            [['address'], 'string', 'max' => 32],
            [['picUrl'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '使用函数创建唯一40位ID',
            'siteId' => '外键，site表ID，函数创建唯一40位ID',
            'chargeName' => '负责人姓名',
            'chargeMobile' => '负责人手机',
            'address' => '站点位置',
            'picUrl' => '站点预览图路径',
        ];
    }
}
