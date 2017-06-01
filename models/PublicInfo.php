<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "publicinfo".
 *
 * @property string $id
 * @property string $title
 * @property string $author
 * @property string $published
 * @property string $content
 * @property integer $category
 * @property string $attachName
 * @property string $attachUrl
 * @property integer $state
 * @property string $picUrl
 * @property integer $conunt
 */
class PublicInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'publicinfo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'title'], 'required'],
            [['published'], 'safe'],
            [['content'], 'string'],
            [['category', 'state', 'conunt'], 'integer'],
            [['id'], 'string', 'max' => 40],
            [['title', 'author', 'attachName', 'attachUrl', 'picUrl'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '使用函数创建唯一40位ID',
            'title' => '标题',
            'author' => '作者',
            'published' => '发布时间',
            'content' => '内容',
            'category' => '分类，字典',
            'attachName' => 'Attach Name',
            'attachUrl' => '附近路径',
            'state' => 'State',
            'picUrl' => 'Pic Url',
            'conunt' => '点击次数',
        ];
    }
}
