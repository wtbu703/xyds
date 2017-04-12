<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ectraininfo".
 *
 * @property string $id
 * @property string $trainId
 * @property double $centralSupport
 * @property double $centralPaid
 * @property double $localSupport
 * @property double $companyPaid
 * @property string $organizer
 * @property string $chargeName
 * @property string $chargeMobile
 * @property string $centralDecisionUnit
 * @property string $decisionFileName
 * @property string $decisionFileUrl
 * @property string $publicInfoUrl
 * @property string $signSheetName
 * @property string $signSheetUrl
 * @property integer $companyNum
 * @property integer $newCompanyThisM
 * @property integer $singleNum
 * @property integer $newSingleThisM
 * @property string $published
 */
class EctrainInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ectraininfo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['centralSupport', 'centralPaid', 'localSupport', 'companyPaid'], 'number'],
            [['companyNum', 'newCompanyThisM', 'singleNum', 'newSingleThisM'], 'integer'],
            [['published'], 'safe'],
            [['id', 'trainId'], 'string', 'max' => 40],
            [['organizer', 'centralDecisionUnit'], 'string', 'max' => 16],
            [['chargeName'], 'string', 'max' => 8],
            [['chargeMobile'], 'string', 'max' => 11],
            [['decisionFileName', 'decisionFileUrl', 'publicInfoUrl', 'signSheetName', 'signSheetUrl'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '使用函数创建唯一40位ID',
            'trainId' => '外键，培训ID，使用函数创建唯一40位ID',
            'centralSupport' => '中央财政资金支持总金额，单位万元',
            'centralPaid' => '中央财政资金已拨付金额，截止上月底，单位万元',
            'localSupport' => '地方财政配套资金总金额，单位万元',
            'companyPaid' => '企业投入资金总金额，单位万元',
            'organizer' => '项目承办单位',
            'chargeName' => '承办单位负责人',
            'chargeMobile' => '负责人联系电话',
            'centralDecisionUnit' => '中央财政资金支持此项目的政府决策单位或领导人',
            'decisionFileName' => '决策文件名称',
            'decisionFileUrl' => '决策文件上传路径',
            'publicInfoUrl' => '信息公开网址链接',
            'signSheetName' => 'Sign Sheet Name',
            'signSheetUrl' => '培训人员签到表上传路径',
            'companyNum' => '企业网商总数（个）',
            'newCompanyThisM' => '当月新孵化企业网商',
            'singleNum' => '个人网商总数（个）',
            'newSingleThisM' => '当月新孵化个人网商',
            'published' => '培训时间',
        ];
    }
}
