<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProfileReviewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profile Reviews';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-reviews-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Profile Reviews', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'date',
            [
                'attribute'=>'date',
                'label' => 'Date',
                'value' => function($model) {
                    return date("h:i a m.d.Y", $model->date);
                }
            ],
            //'to',
            [
                'attribute'=>'to',
                'format' => 'raw',
                'label' => 'To',
                'value' => function($model) {
                    $result='';
                    if(is_object($model->touser)){
                        $result.= Html::a (Html::img(Yii::$app->urlManagerFrontEnd->createUrl("media/profile/avatar/" . $model->touser->getAttribute('avatar')),[
                        'alt'=>'',
                        'class' => 'index_avatar'
                        ]) , Yii::$app->getUrlManager()->getBaseUrl() . '/users/view/'. $model->getAttribute('to'), ['style' => ' display:inline-block;']);
                        $result.= Html::a ( $model->touser->getAttribute('username'), Yii::$app->getUrlManager()->getBaseUrl() . '/users/view/'. $model->getAttribute('to'), ['class' => 'a_index']);
                    }
                    else{
                        $result.=$model->getAttribute('to');
                    }
                    return $result;
                }
            ],
            [   'attribute'=>'from',
                'format' => 'raw',
                'label' => 'From',
                'value' => function($model) {
                    $result='';
                    if(is_object($model->fromuser)){
                         $result.= Html::a (Html::img(Yii::$app->urlManagerFrontEnd->createUrl("media/profile/avatar/" . $model->fromuser->getAttribute('avatar')),[
                        'alt'=>'',
                        'class' => 'index_avatar'
                        ]) , Yii::$app->getUrlManager()->getBaseUrl() . '/users/view/'. $model->getAttribute('from'), ['style' => ' display:inline-block;']);
                        $result.= Html::a ( $model->fromuser->getAttribute('username'), Yii::$app->getUrlManager()->getBaseUrl() . '/users/view/'. $model->getAttribute('from'), ['class' => 'a_index']);
                    }
                    else{
                        $result.=$model->getAttribute('from');
                    }
                    return $result;
                }
            ],
            //'from',
            'review:ntext',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
