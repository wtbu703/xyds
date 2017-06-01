<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "companyrecruit".
 *
 * @property string $id
 * @property string $companyId
 * @property string $position
 * @property string $demand
 * @property string $mobile
 * @property string $tel
 * @property string $email
 * @property string $contacts
 * @property integer $count
 * @property string $datetime
 * @property string $workPlace
 * @property integer $record
 * @property string $salary
 * @property string $exp
 * @property integer $state
 * @property string $place
 */
class CompanyRecruit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'companyrecruit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['demand'], 'string'],
            [['count', 'record', 'state'], 'integer'],
            [['datetime'], 'safe'],
            [['id', 'companyId'], 'string', 'max' => 40],
            [['position', 'mobile', 'tel'], 'string', 'max' => 32],
            [['email', 'contacts', 'salary'], 'string', 'max' => 64],
            [['workPlace', 'exp', 'place'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '使用函数创建唯一40位ID',
            'companyId' => '企业ID，外键，使用函数创建唯一40位ID',
            'position' => '职位',
            'demand' => '要求',
            'mobile' => '11位手机号',
            'tel' => '座机',
            'email' => '邮箱',
            'contacts' => '联系人',
            'count' => '点击次数',
            'datetime' => '时间',
            'workPlace' => '工作地点，详细地址',
            'record' => '学历要求',
            'salary' => '薪资，待遇',
            'exp' => '经验要求',
            'state' => '区分平台招聘和公司招聘的字段',
            'place' => '工作地点',
        ];
    }
}
