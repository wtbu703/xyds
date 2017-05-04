<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "companynews".
 *
 * @property string $id
 * @property string $companyId
 * @property string $title
 * @property string $author
 * @property string $published
 * @property string $content
 * @property string $keyword
 * @property string $attachUrl
 * @property string $attachName
 * @property string $picUrl
 * @property integer $category
 */
class CompanyNews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'companynews';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'companyId', 'title', 'attachUrl'], 'required'],
            [['published'], 'safe'],
            [['content'], 'string'],
            [['category'], 'integer'],
            [['id', 'companyId'], 'string', 'max' => 40],
            [['title', 'attachUrl', 'attachName', 'picUrl'], 'string', 'max' => 64],
            [['author', 'keyword'], 'string', 'max' => 16],
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
            'title' => '新闻标题',
            'author' => '来源',
            'published' => '发布时间',
            'content' => '内容',
            'keyword' => '关键词，分号分隔',
            'attachUrl' => '附件路径',
            'attachName' => '附件名',
            'picUrl' => 'Pic Url',
            'category' => '新闻类别',
        ];
    }
}
