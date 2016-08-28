<?php
namespace backend\models;
use Yii;


/**
 * This is the model class for table "user_videos".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $link
 * @property string $name
 */
class UserVideos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
    */
    public static function tableName()
    {
        return 'user_videos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'link', 'name'], 'required'],
            [['user_id'], 'integer'],
            [['link', 'name'], 'string', 'max' => 255]
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
            'link' => 'Link',
            'name' => 'Name',
        ];
    }
    
    //Rull connection to User model(table)
    public function getUsers()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
