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
 * @property string $siteId
 * @property string $companyId
 * @property string $created_at
 * @property string $updated_at
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
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['id', 'username', 'truename', 'email'], 'string', 'max' => 32],
            [['password'], 'string', 'max' => 64],
            [['telephone'], 'string', 'max' => 16],
            [['state'], 'string', 'max' => 4],
            [['siteId', 'companyId'], 'string', 'max' => 40],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '管理员ID，40位唯一标识符',
            'username' => '管理员用户名',
            'password' => '管理员密码',
            'truename' => '真实姓名',
            'email' => '电邮',
            'telephone' => '电话',
            'state' => '状态',
            'siteId' => '服务站点ID',
            'companyId' => '企业ID',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
        ];
    }
}
