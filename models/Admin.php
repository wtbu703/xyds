<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "admin".
 *
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $truename
 * @property string $email
 * @property string $telephone
 * @property string $state
 */
class Admin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin';
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'truename' => 'Truename',
            'email' => 'Email',
            'telephone' => 'Telephone',
            'state' => 'State',
        ];
    }
}
