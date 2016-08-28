<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AuthItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Auth Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            //'type',
            //'description:ntext',
           // 'description_en:ntext',
           // 'rule_name',
            // 'data:ntext',
            // 'created_at',
            // 'updated_at',
            //['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{rolerules}',
                'contentOptions' =>['class' => 'table_buttons'],
                'buttons' => [
//                    'usersportfolio' => function ($url, $model) {
//                        return Html::a('<span class="glyphicon glyphicon-book"></span>', Yii::$app->getUrlManager()->getBaseUrl() . '/portfolio/usersportfolio/'. $model->getAttribute('id'), ['title' => Yii::t('app', 'Portfolios')]);
//                    },
//                    'usershonours' => function ($url, $model) {
//                        return Html::a('<span class="glyphicon glyphicon-list"></span>', ['user-honours/usershonours', 'id' => $model->id], ['title' => Yii::t('app', 'Honours')]);
//                    },
                    'rolerules' => function ($url, $model) {
                        if($model->name!="admin")
                        return Html::a('<span class="glyphicon glyphicon-check"></span>', ['action/rolerules', 'id' => $model->name], ['title' => Yii::t('app', 'Videos')]);
                        else{
                            return "";
                        }
                    },
                            
                ],
            ],
        ],
    ]); ?>
</div>
