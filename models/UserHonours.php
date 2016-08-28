<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_honours".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property integer $moderation
 */
class UserHonours extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_honours';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'name'], 'required'],
            [['user_id', 'moderation'], 'integer'],
            [['name'], 'string', 'max' => 255]
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
            'name' => 'Description',
            'moderation' => 'Moderation',
        ];
    }

    //Rull connection to ItemDescription model(table)
    public function getUsers()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
