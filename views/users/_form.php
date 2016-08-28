<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */

    //add scropt for dropzone
    $this->registerJsFile('@web/js/userForm.js',['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="user-form">
    <div class="row">
        <h4 class="promote drop"></h4>
        <div class="dropzone" id="dropzone0"></div>
    </div>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'imageFile', [ 'options' => [ 'style' => 'display: none']])->fileInput(['multiple' => false, 'class' => 'input_image_faile', "accept"=>"image/*;capture=camera", "id"=>"open_browse0"]) ?>

    <?php //echo $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ;

    echo $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ;

    //echo $form->field($model, 'account_activation_token')->textInput(['maxlength' => true]) ;

    //echo $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country')->dropDownList($countries) ?>

    <?= $form->field($model, 'roles')->dropDownList($roles)?>

    <?= $form->field($model, 'status')->dropDownList($statuses) ?>

    <?php echo $form->field($model, 'paid_status')->textInput() ;

    //echo $form->field($model, 'created_at')->textInput();

    //echo $form->field($model, 'updated_at')->textInput(); ?>
    <?= $form->field($model, 'avatar' )->hiddenInput(['value'=>$model->getAttribute('avatar')])->label(false) ?>

    <?= $form->field($model, 'background')->textInput() ?>
    <?= $form->field($model, 'specialization')->dropDownList($specialization) ?>
    <?= $form->field($model, 'message')->textInput() ?>
    <?= $form->field($model, 'link_user_site')->textInput() ?>
    <?= $form->field($model, 'link_linkedin')->textInput() ?>
    <?= $form->field($model, 'link_tumblr')->textInput() ?>
    <?= $form->field($model, 'link_fb')->textInput() ?>
    <?= $form->field($model, 'link_tw')->textInput() ?>
    <?= $form->field($model, 'link_inst')->textInput() ?>
    <?= $form->field($model, 'link_behance')->textInput() ?>
    <?= $form->field($model, 'link_google')->textInput() ?>
    <?= $form->field($model, 'link_pint')->textInput() ?>
    <?= $form->field($model, 'link_blg')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); 
    ?>

</div>
