<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "action".
 *
 * @property integer $id
 * @property string $action
 * @property string $controller
 * @property string $description
 *
 * @property Rules[] $rules
 */
class Action extends \yii\db\ActiveRecord
{
    public static $role="";
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'action';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['action', 'controller', 'description'], 'required'],
            [['action', 'controller'], 'string', 'max' => 32],
            [['description'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'action' => 'Action',
            'controller' => 'Controller',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
    */
    public function getRules()
    {
        if(self::$role){
            return $this->hasMany(Rules::className(), ['action_id' => 'id'])->andOnCondition(['name_auth' => self::$role]);
        }
        else{
            return $this->hasMany(Rules::className(), ['action_id' => 'id']);
        }
    }

    /**
     * @param string $controller Controller title
     * @param string $action Action title
     * @return array 
    */
    public static function controllerRoles($controller, $action){
        $query_result=self::find()->where(['controller'=>$controller])->andWhere(['action'=>$action])->one();

        $returnResult=[];

        foreach ($query_result->rules as $item){
            if($item->getAttribute('name_auth')!='admin' && $item->getAttribute('status')==1)
            $returnResult[]=$item->getAttribute('name_auth');
        }
        $returnResult[]='admin';
        return $returnResult;
    }
    
    /**
     * @param string $controller Controller title
     * @return array 
    */
    public static function controllerRules($controller){
        $query_result=self::find()->where(['controller'=>$controller])->all();

        $returnResult=[];
        foreach ($query_result as $value){
            $allRoles=[];
            foreach ($value->rules as $item){
                if( $item->getAttribute('name_auth')!='admin' && $item->getAttribute('status')==1){
                    $allRoles[]=$item->getAttribute('name_auth');
                }
            }
            if($allRoles){
                $returnResult[]=['actions' => [$value->action],
                                 'allow' => true,
                                 'roles' => $allRoles];
            }
        }
         $returnResult[]=                   [
                        'allow' => true,
                        'roles' => ['admin'],
                    ];
        return  $returnResult;
    }
}
