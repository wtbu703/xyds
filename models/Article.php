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
 * @property string $catchtime
 * @property string $keyword
 * @property string $sourceUrl
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
            [['category'], 'integer'],
            [['content'], 'string'],
            [['datetime'], 'safe'],
            [['id', 'sourceUrl'], 'string', 'max' => 64],
            [['title', 'attachUrls', 'keyword'], 'string', 'max' => 32],
            [['author', 'attachNames', 'catchtime'], 'string', 'max' => 16],
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
            'catchtime' => '抓取时间',
            'keyword' => '关键词',
            'sourceUrl' => '来源网址链接，如果有',
        ];
    }
}
