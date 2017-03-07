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
            [['gender', 'age'], 'integer'],
            [['id', 'trainId'], 'string', 'max' => 40],
            [['truename'], 'string', 'max' => 8],
            [['idCardNo'], 'string', 'max' => 18],
            [['mobile'], 'string', 'max' => 11],
            [['address'], 'string', 'max' => 32],
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
            'truename' => 'Truename',
            'idCardNo' => 'Id Card No',
            'mobile' => 'Mobile',
            'address' => 'Address',
            'gender' => 'Gender',
            'age' => 'Age',
        ];
    }
}
