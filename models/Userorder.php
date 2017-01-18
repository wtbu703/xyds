<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "userorder".
 *
 * @property string $id
 * @property string $orderNo.
 * @property string $cost
 * @property string $userID
 * @property string $name
 * @property string $mobile
 * @property string $address
 * @property string $postCode
 * @property string $dateTime
 * @property integer $orderState
 */
class Userorder extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'userorder';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['dateTime'], 'safe'],
            [['orderState'], 'integer'],
            [['id', 'orderNo', 'cost'], 'string', 'max' => 32],
            [['userID', 'address'], 'string', 'max' => 64],
            [['name', 'mobile'], 'string', 'max' => 16],
            [['postCode'], 'string', 'max' => 6]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'orderNo' => 'Order No',
            'cost' => 'Cost',
            'userID' => 'User ID',
            'name' => 'Name',
            'mobile' => 'Mobile',
            'address' => 'Address',
            'postCode' => 'Post Code',
            'dateTime' => 'dateTime',
            'orderState' => 'Order State',
        ];
    }
}
