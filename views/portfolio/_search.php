<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PortfolioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="portfolio-search">
<div class="row">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'item_id', ['options' => [ 'class' => 'col-sm-2']]) ?>

    <?php //echo $form->field($model, 'owner_id', ['options' => [ 'class' => 'col-sm-2']]) ?>

    <?php //echo $form->field($model, 'images', ['options' => [ 'class' => 'col-sm-1']])?> 

    <?= $form->field($model, 'moderation', ['options' => [ 'class' => 'col-sm-2']])->dropDownList([ '0' => 'No', '1' => 'Yes']) ?>

    <?= $form->field($model, 'status', ['options' => [ 'class' => 'col-sm-2']]) ?>

    <?php // echo $form->field($model, 'likes') ?>

    <?php // echo $form->field($model, 'views') ?>

    <?php // echo $form->field($model, 'group_id') ?>

    <?php // echo $form->field($model, 'date') ?>
 </div>   
    <div class="row">
        <div class="form-group">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary col-sm-offset-4 col-sm-2']) ?>
            <?= Html::resetButton('Reset', ['class' => 'btn btn-default col-sm-2']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

    
</div>
