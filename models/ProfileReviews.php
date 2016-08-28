<?php

namespace backend\models;
use Yii;

/**
 * This is the model class for table "profile_reviews".
 *
 * @property integer $id
 * @property integer $date
 * @property integer $to
 * @property integer $from
 * @property string $review
 */
class ProfileReviews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
    */
    public static function tableName()
    {
        return 'profile_reviews';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'to', 'from'], 'integer'],
            [['to', 'from', 'review'], 'required'],
            [['review'], 'string']
        ];
    }

    /**
        * @inheritdoc
    */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'to' => 'To',
            'from' => 'From',
            'review' => 'Review',
        ];
    }

    //Rull connection to User model(table) (comment to user)
    public function getTouser()
    {
        return $this->hasOne(Users::className(), ['id' => 'to']);
    }
    //Rull connection to User model(table) (comment from user)
    public function getFromuser()
    {
        return $this->hasOne(Users::className(), ['id' => 'from']);
    }
}