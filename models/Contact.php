<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contact".
 *
 * @property string $id
 * @property string $truename
 * @property string $mobile
 * @property string $email
 * @property string $QQ
 * @property string $content
 */
class Contact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'truename'], 'required'],
            [['content'], 'string'],
            [['id'], 'string', 'max' => 40],
            [['truename'], 'string', 'max' => 8],
            [['mobile'], 'string', 'max' => 11],
            [['email'], 'string', 'max' => 16],
            [['QQ'], 'string', 'max' => 12],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'truename' => 'Truename',
            'mobile' => 'Mobile',
            'email' => 'Email',
            'QQ' => 'Qq',
            'content' => 'Content',
        ];
    }
}
