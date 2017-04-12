<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "logisticsbuild".
 *
 * @property string $id
 * @property double $townCover
 * @property double $villageCover
 * @property integer $countyToVillage
 * @property integer $villageToHamlet
 * @property string $receiveNum
 * @property integer $sendNum
 * @property string $published
 * @property integer $orderBy
 */
class LogisticsBuild extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'logisticsbuild';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['townCover', 'villageCover'], 'number'],
            [['countyToVillage', 'villageToHamlet', 'receiveNum', 'sendNum', 'orderBy'], 'integer'],
            [['published'], 'safe'],
            [['id'], 'string', 'max' => 40],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '使用函数创建唯一40位ID',
            'townCover' => '乡镇快递覆盖率%',
            'villageCover' => '行政村覆盖率%',
            'countyToVillage' => '县到乡的快递企业数量（个）',
            'villageToHamlet' => '乡到村的快递企业数量（个）',
            'receiveNum' => '当月本县快递收件数量（件）',
            'sendNum' => '发件数量（件）',
            'published' => '时间',
            'orderBy' => '排序',
        ];
    }
}
