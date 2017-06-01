<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property string $id
 * @property integer $category
 * @property string $title
 * @property string $content
 * @property string $author
 * @property string $datetime
 * @property string $attachUrls
 * @property string $attachNames
 * @property integer $catchState
 * @property string $keyword
 * @property string $sourceUrl
 * @property string $picUrl
 * @property integer $count
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['category', 'catchState', 'count'], 'integer'],
            [['content'], 'string'],
            [['datetime'], 'safe'],
            [['id', 'title', 'author', 'attachUrls', 'attachNames', 'keyword', 'sourceUrl'], 'string', 'max' => 64],
            [['picUrl'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category' => '类别，调用字典',
            'title' => 'Title',
            'content' => 'Content',
            'author' => 'Author',
            'datetime' => 'Datetime',
            'attachUrls' => 'Attach Urls',
            'attachNames' => 'Attach Names',
            'catchState' => '抓取时间',
            'keyword' => '关键词',
            'sourceUrl' => '来源',
            'picUrl' => 'Pic Url',
            'count' => '点击次数',
        ];
    }
}
