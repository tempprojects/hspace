<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
// var_dump($deleteaction);
// die;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel, 'searchAction'=>$searchAction]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            //'auth_key',
            //'password_hash',
            //'account_activation_token',
            // 'password_reset_token',
            [
                'label' => 'Avatar',
                'format' => 'raw',
                'value' => function($data){
                    $result="";
                    if ($data->avatar){
                        $result.=Html::img(Yii::$app->urlManagerFrontEnd->createUrl('media/profile/avatar/'.$data->avatar),[
                            'alt'=>'',
                            'style' => 'width:50px;'
                        ]);
                    }
                    return $result;
                },
            ],
             'email:email',
             'first_name',
            // 'last_name',
            // 'city',
            // 'country',
             'roles',
              [                      
                'label' => 'Activation Status',
                'value' => function($model) {
                    return $model->current_status_name;
                }
             ],
             'paid_status',
            // 'created_at',
            // 'updated_at',

            //['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}{delete}{usersportfolio}{usershonours}{usersvideos}',
                'contentOptions' =>['class' => 'table_buttons'],
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, ['title' => Yii::t('app', 'Delete'), 'data' => ['confirm' => 'Are you sure you want to delete this item?','method' => 'post'], 'data-ajax' => '1', 'class'=>'modificator']);
                    },
                    'usersportfolio' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-book"></span>', Yii::$app->getUrlManager()->getBaseUrl() . '/portfolio/usersportfolio/'. $model->getAttribute('id'), ['title' => Yii::t('app', 'Portfolios')]);
                    },
                    'usershonours' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-list"></span>', ['user-honours/usershonours', 'id' => $model->id], ['title' => Yii::t('app', 'Honours')]);
                    },
                    'usersvideos' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-play"></span>', ['user-videos/usersvideos', 'id' => $model->id], ['title' => Yii::t('app', 'Videos')]);
                    },
                ],
            ],

        ],
    ]); ?>
    
</div>
