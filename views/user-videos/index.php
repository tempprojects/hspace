<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserVideosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Videos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-videos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('Create User Videos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [   'attribute'=>'user_id',
                'format' => 'raw',
                'label' => 'Owner(username)',
                'value' => function($model) {
                    $result='';
                    if(is_object($model->users)){
                        $result.= Html::a (Html::img(Yii::$app->urlManagerFrontEnd->createUrl("media/profile/avatar/" . $model->users->getAttribute('avatar')),[
                        'alt'=>'',
                        'class' => 'index_avatar'
                        ]) , Yii::$app->getUrlManager()->getBaseUrl() . '/users/view/'. $model->getAttribute('user_id'), ['style' => ' display:inline-block;']);
                        $result.= Html::a ( $model->users->getAttribute('username'), Yii::$app->getUrlManager()->getBaseUrl() . '/users/view/'. $model->getAttribute('user_id'), ['class' => 'a_index']);
                    }
                   return $result;
                }
            ],
            [
                'label' => 'Video',
                'format' => 'raw',
                'value' =>  function($model) {
                    return "<iframe width='360' height='215' src='" . $model->getAttribute('link') . "' frameborder='0' allowfullscreen></iframe>";
                },
                'visible'=>true
            ],
            'name',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
