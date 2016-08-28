<?php
namespace backend\models;

use Yii;

/**
 * This is the model class for table "rules".
 *
 * @property integer $id
 * @property string $name_auth
 * @property integer $action_id
 * @property integer $status
 *
 * @property Action $action
 */
class Rules extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rules';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_auth', 'action_id', 'status'], 'required'],
            [['action_id', 'status'], 'integer'],
            [['name_auth'], 'string', 'max' => 64],
            [['action_id'], 'exist', 'skipOnError' => true, 'targetClass' => Action::className(), 'targetAttribute' => ['action_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
    */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_auth' => 'Name Auth',
            'action_id' => 'Action ID',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAction()
    {
        return $this->hasOne(Action::className(), ['id' => 'action_id']);
    }
}
