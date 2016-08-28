<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PortfolioCollections */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Portfolio Collections', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="portfolio-collections-view">

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
                is_object($model->users)? Html::a (Html::img(Yii::$app->urlManagerFrontEnd->createUrl("media/profile/avatar/" . $model->users->getAttribute('avatar')),[
                        'alt'=>'',
                        'class' => 'view_avatar'
                    ]), Yii::$app->getUrlManager()->getBaseUrl() . '/users/view/'. $model->getAttribute('user_id'), ['style' => ' display:inline-block;'])
                . Html::a ( $model->users->getAttribute('username'), Yii::$app->getUrlManager()->getBaseUrl() . '/users/view/'. $model->getAttribute('user_id'), ['class' => 'username_view']):" ",
                'visible'=>true
            ],
            [
                'label' => 'Works',
                'format' => 'raw',
                'value' =>$model->detailViewCollection(),
                'visible'=>true
            ],
            [
                'label' => 'Main Work',
                'format' => 'raw',
                'value' =>$model->detailViewMainWork(),
                'visible'=>true
            ],
            'name',
            'about:ntext',
        ],
    ]) ?>

</div>
