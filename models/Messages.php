<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "messages".
 *
 * @property integer $id_mes
 * @property integer $to
 * @property integer $from
 * @property string $message
 * @property string $file_app
 * @property integer $status
 * @property string $created_at
 */
class Messages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'messages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['to', 'from', 'message'], 'required'],
            [['to', 'from', 'status'], 'integer'],
            [['message'], 'string'],
            [['created_at'], 'safe'],
            [['file_app'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_mes' => 'Id Mes',
            'to' => 'To',
            'from' => 'From',
            'message' => 'Message',
            'file_app' => 'File App',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }
}
