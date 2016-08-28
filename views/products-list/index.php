<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\data\ActiveDataProvider;
use frontend\account\models\Catalog;

/* @var $this yii\web\View */
/* @var $model backend\models\ProductsList */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publicity-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'product_name',
            'meta_tags',
            'price',
            [
                'label' => 'Main Image',
                'format' => 'raw',
                'value' => function($data){
                    $result="";
                  
                    if ($data->main_image) {
                        $result.=Html::img(Yii::$app->urlManagerFrontEnd->createUrl('media/products/'.$data->main_image),
                            [ 'alt'=>'','style' => 'width:120px;']);
                    }
                    return $result;
                },
            ],


            'prod_desc:ntext',
            [
                'label' => 'Catalog',
                'value' => function($data){
                    $title = Catalog::findOne($data->id_catalog);
                    return $title->title;
                },
            ],
            'stock',


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>




</div>
