<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "company-news".
 *
 * @property string $id
 * @property string $companyId
 * @property string $title
 * @property string $published
 * @property string $content
 * @property string $keyword
 * @property string $attachUrl
 */
class CompanyNews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'companyNews';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'companyId', 'title'], 'required'],
            [['published'], 'safe'],
            [['content'], 'string'],
            [['id', 'companyId'], 'string', 'max' => 40],
            [['title', 'keyword'], 'string', 'max' => 16],
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
            'companyId' => 'Company ID',
            'title' => 'Title',
            'published' => 'Published',
            'content' => 'Content',
            'keyword' => 'Keyword',
            'attachUrl' => 'Attach Url',
        ];
    }
}
