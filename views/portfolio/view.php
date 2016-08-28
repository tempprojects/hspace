<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Portfolio */

$this->title = $model->item_id;
$this->params['breadcrumbs'][] = ['label' => 'Portfolios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="portfolio-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->item_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->item_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'item_id',
            [
                'label' => 'Owner',
                'format' => 'raw',
                'value' =>
                is_object($model->users)?Html::a (Html::img(Yii::$app->urlManagerFrontEnd->createUrl("media/profile/avatar/" . $model->users->getAttribute('avatar')),[
                        'alt'=>'',
                        'class' => 'view_avatar'
                    ]), Yii::$app->getUrlManager()->getBaseUrl() . '/users/view/'. $model->getAttribute('owner_id'), ['style' => ' display:inline-block;'])
                . Html::a ( $model->users->getAttribute('username'), Yii::$app->getUrlManager()->getBaseUrl() . '/users/view/'. $model->getAttribute('owner_id'), ['class' => 'username_view']):"",
                'visible'=>true
            ],
            [
                'label' => 'images',
                'format' => 'raw',
                'value' => $model->imagesForDetailView(),
                'visible'=>true
            ],
            [
                'label' => 'Moderation',
                'format' => 'raw',
                'value' =>  $model->getAttribute('moderation') ? "Yes":"No",
                'visible'=>true
            ],
            'status',
            'style_id',
            'likes',
            [
                'label' => 'Real Likes',
                'format' => 'raw',
                'value' => $model->realikes,
                'visible' => true
            ],
            'views',
            'group_id',
            [
                'label' => 'date',
                'format' => 'raw',
                'value' =>  $model->getAttribute('date') ? date("h:i a m.d.Y", $model->getAttribute('date')):" ",
                'visible'=>true
            ],
        ],
    ]) ?>
    
    <?php 
    foreach($model->itemDescription as $key => $value){
        echo "<br><h1>Language: '" . $model->itemDescription[$key]->getAttribute('language') . "'</h1>";
        echo DetailView::widget([
            'model' => $model->itemDescription[$key],
            'attributes' => [
                'id',
                'item_id',
                'title',
                'language',
                'description',
                'short_description',
                'tags',
                'meta'
            ],
         ]); 
    }
//        echo  DetailView::widget([
//            'model' => $model->itemDescription,
//            'attributes' => [
//                'id',
//                'item_id',
//                'title',
//                'language',
//                'description',
//                'short_description',
//                'tags',
//                'meta'
//            ],
//        ]) 
    ?>

</div>
