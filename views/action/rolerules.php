<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ActionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->registerJsFile('@web/js/checkboxRules.js',['depends' => [\yii\web\JqueryAsset::className()]]);
$this->title = 'Role "' . $role . '"';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .glyphicon-plus:hover, .glyphicon-minus:hover{
        cursor: pointer;
    }
</style>
<div class="action-rolerules">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'action',
            'controller',
            'description',
            [
                'label' => 'Rule',
                'format' => 'raw',
                'value' => function($data){
                    $result="<div class='rule' data-role='" . $data::$role ."' data-id='" . $data->getAttribute('id') ."' >";

                    if($data->rules){
                        if($data->rules[0]->getAttribute('status')){
                            $result .='<span class="glyphicon glyphicon-plus"></span>'; 
                        }
                        else{
                            $result .='<span class="glyphicon glyphicon-minus"></span>'; 
                        }
                    }
                    else{
                        $result .='<span class="glyphicon glyphicon-minus"></span>';
                    }

                    return $result . '</div>';
                },
            ],
        ],
    ]); ?>
</div>

<script>
    
</script>
