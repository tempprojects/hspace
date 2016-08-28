<?php

namespace backend\models;
use Yii;

/**
 * This is the model class for table "likes".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $object_id
 * @property integer $category
 */
class Likes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'likes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'object_id', 'category'], 'required'],
            [['user_id', 'object_id', 'category'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'object_id' => 'Object ID',
            'category' => 'Category',
        ];
    }

    /**
     * Get real likes for item
     *
     * @param int $id ithem id
     * @param category $categoty ithem category
     * @return (int) like count
    */
    public static function Reallikes($id, $category){
        $count = static::find()
            ->where(['and',['object_id'=>$id],['category'=>$category]])
            ->count();
        return $count?$count:0;
    }
}
