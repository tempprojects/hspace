<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ProfileReviews */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Profile Reviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-reviews-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'date',
            //'to',
            [
                'label' => 'To',
                'format' => 'raw',
                'value' =>
                is_object($model->fromuser) ? Html::a (Html::img(Yii::$app->urlManagerFrontEnd->createUrl("media/profile/avatar/" . $model->touser->getAttribute('avatar')),[
                        'alt'=>'',
                        'class' => 'view_avatar'
                    ]), Yii::$app->getUrlManager()->getBaseUrl() . '/users/view/'. $model->getAttribute('to'), ['style' => ' display:inline-block;'])
                . Html::a ( $model->fromuser->getAttribute('username'), Yii::$app->getUrlManager()->getBaseUrl() . '/users/view/'. $model->getAttribute('to'), ['class' => 'username_view']):("id: " . $model->getAttribute('to')) ,
                'visible'=>true
            ],
            [
                'label' => 'From',
                'format' => 'raw',
                'value' =>
                is_object($model->fromuser) ? Html::a (Html::img(Yii::$app->urlManagerFrontEnd->createUrl("media/profile/avatar/" . $model->fromuser->getAttribute('avatar')),[
                        'alt'=>'',
                        'class' => 'view_avatar'
                    ]), Yii::$app->getUrlManager()->getBaseUrl() . '/users/view/'. $model->getAttribute('from'), ['style' => ' display:inline-block;'])
                . Html::a ( $model->fromuser->getAttribute('username'), Yii::$app->getUrlManager()->getBaseUrl() . '/users/view/'. $model->getAttribute('from'), ['class' => 'username_view']):("id: " . $model->getAttribute('from')),
                'visible'=>true
            ],
            //'from',
            'review:ntext',
        ],
    ]) ?>

</div>
