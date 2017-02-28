<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "servicesystembuild".
 *
 * @property string $id
 * @property string $name
 * @property string $address
 * @property string $function
 * @property string $chargeName
 * @property string $chargeMobile
 * @property string $code
 * @property integer $isCountyLogistics
 * @property integer $isTownLogistics
 * @property string $config
 * @property string $centralSupportContent
 * @property string $buildProgress
 * @property double $centralSupport
 * @property double $centralPaid
 * @property double $localSupport
 * @property double $companyPaid
 * @property string $organizer
 * @property string $chargeName1
 * @property string $chargeMobile1
 * @property string $centralDecisionUnit
 * @property string $decisionFileUrl
 * @property string $publicInfoUrl
 * @property string $published
 */
class ServiceSystemBuild extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'servicesystembuild';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['isCountyLogistics', 'isTownLogistics'], 'integer'],
            [['centralSupportContent'], 'string'],
            [['centralSupport', 'centralPaid', 'localSupport', 'companyPaid'], 'number'],
            [['published'], 'safe'],
            [['id'], 'string', 'max' => 40],
            [['name', 'function', 'code', 'config', 'decisionFileUrl', 'publicInfoUrl'], 'string', 'max' => 64],
            [['address'], 'string', 'max' => 128],
            [['chargeName', 'buildProgress', 'chargeName1'], 'string', 'max' => 8],
            [['chargeMobile', 'chargeMobile1'], 'string', 'max' => 11],
            [['organizer', 'centralDecisionUnit'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '使用函数创建唯一40位ID',
            'name' => '项目建设名称',
            'address' => '详细地址',
            'function' => '主要功能',
            'chargeName' => '负责人',
            'chargeMobile' => '负责人联系电话',
            'code' => '服务站ID',
            'isCountyLogistics' => '是否与县级物流配送中心共享场地和站点',
            'isTownLogistics' => '是否承担乡镇级（村级）物流服务点功能',
            'config' => '设施配置',
            'centralSupportContent' => '中央财政资金支持建设内容',
            'buildProgress' => '项目建设进度',
            'centralSupport' => '中央财政资金支持总金额，单位万元',
            'centralPaid' => '中央财政资金已拨付金额，截止上月底，单位万元',
            'localSupport' => '地方财政配套资金总金额，单位万元',
            'companyPaid' => '企业投入资金总金额，单位万元',
            'organizer' => '项目承办单位',
            'chargeName1' => '承办单位负责人',
            'chargeMobile1' => '承办单位负责人联系电话',
            'centralDecisionUnit' => '中央财政资金支持此项目的政府决策单位或领导人',
            'decisionFileUrl' => '决策文件上传路径',
            'publicInfoUrl' => '信息公开网址链接',
            'published' => 'Published',
        ];
    }
}
