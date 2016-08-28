<?php

namespace backend\models;
use backend\models\Portfolio;
use yii\helpers\Html;
use Yii;

/**
 * This is the model class for table "portfolio_collections".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $items
 * @property integer $main
 * @property string $name
 * @property string $about
 */
class PortfolioCollections extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'portfolio_collections';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'items', 'main', 'name', 'about'], 'required'],
            [['user_id', 'main'], 'integer'],
            [['about'], 'string'],
            [['items', 'name'], 'string', 'max' => 255]
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
            'items' => 'Items',
            'main' => 'Main',
            'name' => 'Name',
            'about' => 'About',
        ];
    }

    //Rull connection to Portfolio model(table) and return array of founded portfolio objects
    public function getPortfolio()
    {
        $items_id = explode("|", $this->items);
        $items_ids = array_filter($items_id);
        $result = Portfolio::find()->select('*');
        $cnt=0;
        foreach($items_ids as $item){
            if($item!=""){
                if(!$cnt){
                    $result=$result->Where(['item_id' => $item]);
                }
                else{
                    $result=$result->orWhere(['item_id' => $item]);
                }
                $cnt++;
            }
        }
        return   $result->all();
    }

    //Rull connection to User model(table)
    public function getUsers()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    //Function for formating html for displaing pottfolio work in
    //@return sting
    public function detailViewCollection() {
        $result="";
        foreach($this->portfolio as $work){
            $array_images=explode("|", $work->images);
            foreach ($array_images as $value){
                if ($value) {
                    $result.= Html::a (Html::img(Yii::$app->urlManagerFrontEnd->createUrl('media/portfolio/'.$value),[
                        'alt'=>'',
                        'style' => 'width:200px;'
                    ]) , Yii::$app->getUrlManager()->getBaseUrl() . '/portfolio/view/'. $work->getAttribute('item_id'), ['class' => 'a_images']);
                    break;
                }
            }
        }
        return $result;
    }
    
    //Function for formating html for displaing main pottfolio work in
    //@return sting
    public function detailViewMainWork(){
        $result="";
        if($this->main){
            foreach($this->portfolio as $work){
                if($work->item_id==$this->main){
                    $array_images=explode("|", $work->images);
                    foreach ($array_images as $value){
                        if ($value) {
                            $result.= Html::a (Html::img(Yii::$app->urlManagerFrontEnd->createUrl('media/portfolio/'.$value),[
                                'alt'=>'',
                                'style' => 'width:200px;'
                            ]) , Yii::$app->getUrlManager()->getBaseUrl() . '/portfolio/view/'. $work->getAttribute('item_id'), ['class' => 'a_images']);
                            break;
                        }
                    }
                }
            }
        }
        return $result;
    }
}