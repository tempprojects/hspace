<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Publicity;

/* @var $this yii\web\View */
/* @var $model backend\models\Publicity */
/* @var $form yii\widgets\ActiveForm */

//add scropt for dropzone
$this->registerJsFile('@web/js/publicityForm.js',['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="publicity-form">
    <div class="form_create_left">
    <p><b>Image</b></p>
    <div class="row">
        <div class="dropzone" id="dropzone0"></div>
    </div>

<?php
//$is_position = Publicity::find()->select('position')->where(['country_id'=>$_GET['country_id']])->column();
$position = array(
        ['value'=>0, 'title'=>'Top & Bottom', 'url'=>'bottom.jpg'],
        ['value'=>1, 'title'=>'Side', 'url'=>'top_right.jpg'],
        ['value'=>2, 'title'=>'Slider', 'url'=>'slider.jpg'],

    );
$status = array('off','on');

$role = [
    ['value' => 'homeowner', 'title' => 'homeowner'],
    ['value' => 'designer', 'title' => 'designer']];
//$new_position = array();
//foreach($position as $one){
//    if(!in_array($one['value'],$is_position)){
//        $new_position[]=$one;
//    }
//}
?>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <?= $form->field($model, 'imageFile', ['options' => ['style' => 'display: none']])->fileInput(['multiple' => false, 'class' => 'input_image_faile', "accept" => "image/*;capture=camera", "id" => "open_browse0"]) ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'style' => 'width:32.4%;']) ?>

        <?= $form->field($model, 'link')->textInput(['maxlength' => true, 'style' => 'width:32.4%;']) ?>

        <?= $form->field($model, 'image')->hiddenInput(['value' => $model->getAttribute('image')])->label(false) ?>

        <?= $form->field($model, 'country_id')->hiddenInput(['value' => (isset($_GET['country_id'])) ? $_GET['country_id']:0])->label(false) ?>

    </div>

    <div class="form_create_right">
        <?= $form->field($model, 'description')->textarea(['rows' => 6, 'style' => 'width:32.4%;']) ?>

        <?= $form->field($model, 'position')->dropDownList(ArrayHelper::map($position, 'value', 'title'), ['prompt' => 'Select position', 'style' => 'width:32.4%;']) ?>
        <img id="position_view" src="<?= Yii::$app->urlManagerFrontEnd->createUrl('media/banners/');?>" width="130px" height="110px" style="display: none" alt="">

        <?= $form->field($model, 'video')->textInput(['maxlength' => true, 'style' => 'width:32.4%;']) ?>

        <?= $form->field($model, 'role')->dropDownList(ArrayHelper::map($role, 'value', 'title'),['style' => 'width:32.4%;']) ?>

        <?= $form->field($model, 'status')->dropDownList($status,['style' => 'width:32.4%;']) ?>
    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
