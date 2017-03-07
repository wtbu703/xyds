<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "platform-recruit".
 *
 * @property string $id
 * @property string $position
 * @property string $demand
 * @property string $mobile
 * @property string $tel
 * @property string $email
 * @property string $contacts
 */
class PlatformRecruit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'platformRecruit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'position', 'contacts'], 'required'],
            [['demand'], 'string'],
            [['id'], 'string', 'max' => 40],
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
            'position' => 'Position',
            'demand' => 'Demand',
            'mobile' => 'Mobile',
            'tel' => 'Tel',
            'email' => 'Email',
            'contacts' => 'Contacts',
        ];
    }
}
