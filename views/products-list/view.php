<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\account\models\Catalog;

/* @var $this yii\web\View */
/* @var $model backend\models\ProductsList */

$this->title = $model->product_name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publicity-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_prod], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_prod], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php
    if ($model->images != '') {
        $img = explode(',', $model->images);
        $item_img = 0;
        foreach ($img as $item) {
            $item_img++;
            $array[] = [
                'label' => 'Image ' . $item_img,
                'format' => 'raw',
                'value' => Html::img(Yii::$app->urlManagerFrontEnd->createUrl('media/products/' . $item), [
                    'alt' => '',
                    'style' => 'width:140px;'
                ]),
                'visible' => true
            ];
        }
    }
    $array_empty = [
        'label' => 'Image',
        'format' => 'raw',
        'value' => '',
        'visible' => false
    ];
    ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Main Image',
                'format' => 'raw',
                'value' => $model->main_image ? Html::img(Yii::$app->urlManagerFrontEnd->createUrl('media/products/'. $model->main_image),[
                            'alt'=>'',
                            'style' => 'width:250px;'
                        ]): " ",
                'visible'=>true
            ],
//            $array[0]!=""?$array[0]:$array_empty,
//            $array[1]!=""?$array[1]:$array_empty,
//            $array[2]!=""?$array[2]:$array_empty,
            'product_name',
            'meta_tags',
            'prod_desc:ntext',
            'price',
            [
                'label' => 'Catalog',
                'format' => 'raw',
                'value' => Catalog::findOne($model->id_catalog)->title,

            ],
            'stock'

       ],
    ]) ?>

</div>
