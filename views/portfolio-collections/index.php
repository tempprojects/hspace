<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PortfolioCollectionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Portfolio Collections';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="portfolio-collections-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Portfolio Collections', ['create'], ['class' => 'btn btn-success']) ?>
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
                //'items',
                [
                    'label' => 'Works',
                    'format' => 'raw',
                    'value' => function($data){
                     $result="";    
                    foreach($data->portfolio as $work){
                            $array_images=explode("|", $work->images);
                            foreach ($array_images as $value){
                                if ($value) {
                                    $result.= Html::a (Html::img(Yii::$app->urlManagerFrontEnd->createUrl('media/portfolio/'.$value),[
                                        'alt'=>'',
                                        'style' => 'width:100px;'
                                    ]) , Yii::$app->getUrlManager()->getBaseUrl() . '/portfolio/view/'. $work->getAttribute('item_id'), ['class' => 'a_images']);
                                    break;
                                }
                            }
                        }
                        return $result;
                    },
                ],
                'main',
                'name',
                // 'about:ntext',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
