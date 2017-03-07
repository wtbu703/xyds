<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "public-info".
 *
 * @property string $id
 * @property string $title
 * @property string $author
 * @property string $published
 * @property string $content
 * @property integer $category
 * @property string $attachUrl
 */
class PublicInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'publicInfo';
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
            [['category'], 'integer'],
            [['id'], 'string', 'max' => 40],
            [['title'], 'string', 'max' => 16],
            [['author'], 'string', 'max' => 8],
            [['attachUrl'], 'string', 'max' => 64],
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
            'author' => 'Author',
            'published' => 'Published',
            'content' => 'Content',
            'category' => 'Category',
            'attachUrl' => 'Attach Url',
        ];
    }
}
