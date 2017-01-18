<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "article".
 *
 * @property string $id
 * @property string $title
 * @property string $content
 * @property string $author
 * @property string $datetime
 * @property string $attachUrls
 * @property string $attachNames
 * @property string $catchtime
 */
class Article extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    public function rules()
    {
        return [
            [['id', 'title', 'author', 'content'], 'required'],
            [['attachUrls','attachNames'], 'string', 'max' => 1024000*4],
            [['catchtime'], 'string', 'max' => 16]
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'author' => 'Author',
            'datetime' => 'Datetime',
            'attachUrls' => 'attachUrls',
            'attachNames' => 'attachNames',
            'catchtime' => 'catchtime',
        ];
    }
}
