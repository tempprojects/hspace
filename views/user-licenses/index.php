<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserLicensesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Licenses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-licenses-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User Licenses', ['create'], ['class' => 'btn btn-success']) ?>
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
            [
                'label' => 'Images',
                'format' => 'raw',
                'value' => function($data){
                    $result="";
                    $array_images=explode("|", $data->images);
                    foreach ($array_images as $value) {
                        if ($value && $value!=" ") {
                            $result.=Html::img(Yii::$app->urlManagerFrontEnd->createUrl($value),[
                                'alt'=>'',
                                'style' => 'width:100px;'
                            ]);
                        }
                    }
                    return $result;
                },
            ],
            'number',
            'issued_by',
            [
                'attribute'=>'moderation',
                'label' => 'Moderation',
                'value' => function($model) {
                    return $model->getAttribute('moderation') ? "Yes":"No";
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
