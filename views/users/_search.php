<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<style>
    .searchFormTextInput{
        width: 19%;
    }
</style>
<div class="user-search ">
    <div class="row">
    <?php $form = ActiveForm::begin([
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['options' => [ 'class' => 'col-sm-1']]) ?>

    <?php echo $form->field($model, 'username' , ['options' => [ 'class' => 'col-sm-3']]) ?>

    <?php //echo $form->field($model, 'auth_key') ?>

    <?php //echo $form->field($model, 'password_hash') ?>

    <?php //echo $form->field($model, 'account_activation_token') ?>

    <?php // echo $form->field($model, 'password_reset_token') ?>

    <?php  echo $form->field($model, 'email', ['options' => [ 'class' => 'col-sm-3']]) ?>

    <?php  echo $form->field($model, 'first_name', ['options' => [ 'class' => 'col-sm-2']]) ?>

    <?php  echo $form->field($model, 'last_name', ['options' => [ 'class' => 'col-sm-3']]) ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'country') ?>

    <?php // echo $form->field($model, 'roles') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'paid_status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>
</div>
<div class="row">
    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary col-sm-offset-4 col-sm-2']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default col-sm-2']) ?>
    </div>
</div>
    <?php ActiveForm::end(); ?>

</div>
