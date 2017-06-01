<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contact".
 *
 * @property string $id
 * @property string $truename
 * @property string $gender
 * @property string $mobile
 * @property string $email
 * @property string $QQ
 * @property string $content
 * @property string $datetime
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
            [['datetime'], 'safe'],
            [['id'], 'string', 'max' => 40],
            [['truename', 'mobile', 'email'], 'string', 'max' => 32],
            [['gender'], 'string', 'max' => 2],
            [['QQ'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '使用函数创建唯一40位ID',
            'truename' => '姓名',
            'gender' => '性别',
            'mobile' => '11位手机号',
            'email' => '邮箱',
            'QQ' => 'QQ号',
            'content' => '内容',
            'datetime' => '时间',
        ];
    }
}
