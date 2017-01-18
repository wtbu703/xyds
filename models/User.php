<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $sex
 * @property string $mobile
 * @property string $email
 * @property string $qq
 * @property string $address
 * @property integer $certification
 * @property integer $user_type
 * @property string $IDcardNO
 * @property string $truename
 * @property string $register_time
 * @property string $last_login
 * @property string $userState
 * @property Ad[] $ads
 * @property Candidate[] $candidates
 * @property Order[] $orders
 */
class User extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'username', 'password', 'register_time'], 'required'],
            [['certification', 'user_type'], 'integer'],
            [['register_time', 'last_login'], 'safe'],
            [['id', 'address'], 'string', 'max' => 40],
            [['username', 'password', 'email'], 'string', 'max' => 20],
            [['sex','userState'], 'string', 'max' => 1],
            [['mobile'], 'string', 'max' => 11],
            [['qq', 'truename'], 'string', 'max' => 10],
            [['IDcardNO'], 'string', 'max' => 18]
        ];
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
            'sex' => 'Sex',
            'mobile' => 'Mobile',
            'email' => 'Email',
            'qq' => 'Qq',
            'address' => 'Address',
            'certification' => 'Certification',
            'user_type' => 'User Type',
            'IDcardNO' => 'Idcard No',
            'truename' => 'Truename',
            'register_time' => 'Register Time',
            'last_login' => 'Last Login',
            'userState' => 'userState'
        ];
    }
}
