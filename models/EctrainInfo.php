<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ectrain-info".
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
 * @property string $decisionFileUrl
 * @property string $publicInfoUrl
 * @property string $signSheetUrl
 * @property string $published
 */
class EctrainInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ectrainInfo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['centralSupport', 'centralPaid', 'localSupport', 'companyPaid'], 'number'],
            [['published'], 'safe'],
            [['id', 'trainId'], 'string', 'max' => 40],
            [['organizer', 'centralDecisionUnit'], 'string', 'max' => 16],
            [['chargeName'], 'string', 'max' => 8],
            [['chargeMobile'], 'string', 'max' => 11],
            [['decisionFileUrl', 'publicInfoUrl', 'signSheetUrl'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'trainId' => 'Train ID',
            'centralSupport' => 'Central Support',
            'centralPaid' => 'Central Paid',
            'localSupport' => 'Local Support',
            'companyPaid' => 'Company Paid',
            'organizer' => 'Organizer',
            'chargeName' => 'Charge Name',
            'chargeMobile' => 'Charge Mobile',
            'centralDecisionUnit' => 'Central Decision Unit',
            'decisionFileUrl' => 'Decision File Url',
            'publicInfoUrl' => 'Public Info Url',
            'signSheetUrl' => 'Sign Sheet Url',
            'published' => 'Published',
        ];
    }
}
