<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "company-recruit".
 *
 * @property string $id
 * @property string $companyId
 * @property string $position
 * @property string $demand
 * @property string $mobile
 * @property string $tel
 * @property string $email
 * @property string $contacts
 */
class CompanyRecruit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'companyRecruit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'companyId'], 'required'],
            [['demand'], 'string'],
            [['id', 'companyId'], 'string', 'max' => 40],
            [['position', 'tel', 'email'], 'string', 'max' => 16],
            [['mobile'], 'string', 'max' => 11],
            [['contacts'], 'string', 'max' => 8],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'companyId' => 'Company ID',
            'position' => 'Position',
            'demand' => 'Demand',
            'mobile' => 'Mobile',
            'tel' => 'Tel',
            'email' => 'Email',
            'contacts' => 'Contacts',
        ];
    }
}
