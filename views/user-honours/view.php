<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\UserHonours */

$this->title = strip_tags($model->name);
$this->params['breadcrumbs'][] = ['label' => 'User Honours', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Honour id: ' . $model->id;
?>
<div class="user-honours-view">
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
            [
                'label' => 'Owner',
                'format' => 'raw',
                'value' =>
                 is_object($model->users)?Html::a (Html::img(Yii::$app->urlManagerFrontEnd->createUrl("media/profile/avatar/" . $model->users->getAttribute('avatar')),[
                        'alt'=>'',
                        'class' => 'view_avatar'
                    ]), Yii::$app->getUrlManager()->getBaseUrl() . '/users/view/'. $model->getAttribute('user_id'), ['style' => ' display:inline-block;'])
                . Html::a ( $model->users->getAttribute('username'), Yii::$app->getUrlManager()->getBaseUrl() . '/users/view/'. $model->getAttribute('user_id'), ['class' => 'username_view']):" ",
                'visible'=>true
            ],
            'name',
            [
                'label' => 'Moderation',
                'format' => 'raw',
                'value' =>  $model->getAttribute('moderation') ? "Yes":"No",
                'visible'=>true
            ],
        ],
    ]) ?>

</div>