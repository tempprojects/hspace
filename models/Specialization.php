<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "specialization".
 *
 * @property integer $id
 * @property integer $option
 * @property string $name_ru
 * @property string $name_en
 */
class Specialization extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'specialization';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['option'], 'integer'],
            [['name_ru', 'name_en'], 'required'],
            [['name_ru', 'name_en'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'option' => 'Option',
            'name_ru' => 'Name Ru',
            'name_en' => 'Name En',
        ];
    }
}
