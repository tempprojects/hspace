<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use common\models\Country;
use backend\models\Publicity;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model backend\models\Publicity */
/* @var $searchModel backend\models\PublicitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Publicities';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publicity-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['id' => 'country-form', 'action' => ['index'], 'method' => 'get', 'options' => ['data-pjax' => TRUE]]); ?>
        <?= $form->field($model, 'country_id')->dropDownList($country, ['prompt'=> 'Select country','style' => 'width:200px;'])->label(FALSE) ?>
        <div class="form-group" style="position: fixed; top: 142px; left: 450px;">
            <?= Html::submitButton('Select', ['class' => 'btn btn-primary', 'name' => '']) ?>
        </div>
    <?php ActiveForm::end(); ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php if(!empty($_GET['Publicity']['country_id'])){  // check get params?>
        <p>
            <?= Html::a('Create Publicity', ['create','country_id'=>$_GET['Publicity']['country_id']], ['class' => 'btn btn-success']) ?>
        </p>
    <?php } ?>

    <?= GridView::widget([
        'dataProvider' => !empty($_GET['Publicity']['country_id']) ? $dataProvider = new ActiveDataProvider([
            'query' => Publicity::find()->where(['country_id'=>$_GET['Publicity']['country_id']]),
            'pagination' => [
                'pageSize' => 6,
            ],
        ]):$dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'title',
            [
                'label' => 'Image',
                'format' => 'raw',
                'value' => function($data){
                    $result="";
                  
                    if ($data->image) {
                        $result.=Html::img(Yii::$app->urlManagerFrontEnd->createUrl('media/banners/'.$data->image),
                            [ 'alt'=>'','style' => 'width:120px;']);
                    }
                    return $result;
                },
            ],
            'link',
            //'image',
            'description:ntext',
            [
                'label' => 'Position',
                'format' => 'raw',
                'value' => function($data){
                    $result="";
                    $position = array( 'bottom.jpg', 'top_right.jpg', 'slider.jpg');
                    $result.=Html::img(Yii::$app->urlManagerFrontEnd->createUrl('media/banners/'.$position[$data->position]),
                        [ 'alt'=>'','style' => 'width:120px;' ]);
                    return $result;
                },
            ],
            [
                'label' => 'Country',
                'value' => function($data){
                    $countries = Country::getAllCountries();
                    return (isset($countries[$data->country_id]))?$countries[$data->country_id]:0;
                },
            ],
//             'position',
            // 'status',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
