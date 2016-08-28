<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserHonoursSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Honours';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-honours-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User Honours', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [   'attribute'=>'user_id',
                'format' => 'raw',
                'label' => 'User',
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
            'name',
            [
                'attribute'=>'moderation',
                'label' => 'Moderation',
                'value' => function($model) {
                    return $model->getAttribute('moderation') ? "Yes":"No";
                }
            ],

            //['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}{delete}',
                'contentOptions' =>['class' => 'table_buttons'],
            ],
        ],
    ]); ?>

</div>
