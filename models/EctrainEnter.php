<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ectrainenter".
 *
 * @property string $id
 * @property string $trainId
 * @property string $truename
 * @property string $idCardNo
 * @property string $mobile
 * @property string $address
 * @property integer $gender
 * @property integer $age
 * @property string $created
 * @property integer $state
 */
class EctrainEnter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ectrainenter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'truename', 'idCardNo', 'mobile', 'gender', 'age'], 'required'],
            [['gender', 'age', 'state'], 'integer'],
            [['created'], 'safe'],
            [['id', 'trainId'], 'string', 'max' => 40],
            [['truename', 'mobile'], 'string', 'max' => 16],
            [['idCardNo'], 'string', 'max' => 32],
            [['address'], 'string', 'max' => 64],
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
            'truename' => '真实姓名',
            'idCardNo' => '18位身份证号',
            'mobile' => '11位手机号码',
            'address' => '地址',
            'gender' => '性别，字典',
            'age' => '年龄',
            'created' => 'Created',
            'state' => '报名状态',
        ];
    }
}
