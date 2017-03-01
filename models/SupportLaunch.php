<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "supportlaunch".
 *
 * @property string $id
 * @property string $name
 * @property string $centralSupportContent
 * @property double $centralSupport
 * @property double $centralPaid
 * @property double $localSupport
 * @property double $companyPaid
 * @property string $organizer
 * @property string $chargeName
 * @property string $chargeMobile
 * @property string $centralDecisionUnit
 * @property string $decisionFileUrl
 * @property string $publicInfoUrl
 * @property string $published
 */
class SupportLaunch extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'supportlaunch';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['centralSupportContent'], 'string'],
            [['centralSupport', 'centralPaid', 'localSupport', 'companyPaid'], 'number'],
            [['published'], 'safe'],
            [['id'], 'string', 'max' => 40],
            [['name', 'organizer', 'centralDecisionUnit'], 'string', 'max' => 16],
            [['chargeName'], 'string', 'max' => 8],
            [['chargeMobile'], 'string', 'max' => 11],
            [['decisionFileUrl', 'publicInfoUrl'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '项目建设名称',
            'centralSupportContent' => '中央财政资金支持建设内容',
            'centralSupport' => '中央财政资金支持总金额，单位万元',
            'centralPaid' => '中央财政资金已拨付金额，截止上月底，单位万元',
            'localSupport' => '地方财政配套资金总金额，单位万元',
            'companyPaid' => '企业投入资金总金额，单位万元',
            'organizer' => '项目承办单位',
            'chargeName' => '承办单位负责人',
            'chargeMobile' => '负责人联系电话',
            'centralDecisionUnit' => '中央财政资金支持此项目的政府决策单位或领导人',
            'decisionFileUrl' => '决策文件上传路径',
            'publicInfoUrl' => '信息公开网址链接',
            'published' => 'Published',
        ];
    }
}
