<?php
namespace backend\models;

use Yii;

/**
 * This is the model class for table "language".
 *
 * @property integer $id
 * @property string $url
 * @property string $local
 * @property string $name
 * @property integer $default
 * @property string $image
 * @property integer $sort_order
 */
class Language extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'language';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url', 'local', 'name', 'image'], 'required'],
            [['default', 'sort_order'], 'integer'],
            [['url', 'local', 'name'], 'string', 'max' => 255],
            [['image'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'local' => 'Local',
            'name' => 'Name',
            'default' => 'Default',
            'image' => 'Image',
            'sort_order' => 'Sort Order',
        ];
    }
}
