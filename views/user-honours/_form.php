<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
/* @var $this yii\web\View */
/* @var $model backend\models\UserHonours */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-honours-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>
    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'moderation')->dropDownList([ '0' => 'No', '1' => 'Yes'])?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
