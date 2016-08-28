<?php
namespace backend\models;
use Yii;
/**
 * This is the model class for table "item_description".
 *
 * @property integer $id
 * @property integer $item_id
 * @property string $language
 * @property string $title
 * @property string $description
 * @property string $short_description
 * @property string $tags
 * @property string $meta
 */
class ItemDescription extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_description';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id'], 'required'],
            [['item_id'], 'integer'],
            [['description', 'short_description'], 'string'],
            [['language'], 'string'],
            [['title', 'tags', 'meta'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item_id' => 'Item ID',
            'language' => 'Language',
            'title' => 'Title',
            'description' => 'Description',
            'short_description' => 'Short Description',
            'tags' => 'Tags',
            'meta' => 'Meta',
        ];
    }
    public function getPortfolio()
    {
        return $this->hasOne(Portfolio::className(), ['item_id' => 'item_id']);
    }   
}
