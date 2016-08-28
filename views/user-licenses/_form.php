<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserLicenses */
/* @var $form yii\widgets\ActiveForm */
  $this->registerJsFile('@web/js/licenseForm.js',['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<style>
.close_png{
	position: absolute;
	top: 0%;
	right: 0%;
	width: 5%;
}        
.close_png:hover{
	cursor: pointer;
	/*background-color: gray; */
	opacity: 0.6;
}    
</style>
<div class="user-licenses-form">
    <div class="row images_thumbnails">
         <?php 
            $i=0;
            $images=  explode("|", $model->getAttribute('images'));
            foreach($images as $value):
                 if($value):
            ?>
                <div class="dropzone" id="dropzone<?= $i;?>" style="background: url('<?php echo Yii::$app->urlManagerFrontEnd->createUrl($value);?>');">
                    <span class="close">X</span>
                </div>
        <?php $i++; endif; endforeach; ?>
        <div class="dropzone" id="dropzone<?= $i; ?>" style="background: url('<?php echo Yii::$app->urlManager->createUrl('images/no-img.png');?>');">
            <span class="close">X</span>
        </div>
    </div>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);; ?>
    

    <?php 
    $i=0;
    foreach($images as $value){
        if($value){
            echo  $form->field($model, 'imageFile[]', [ 'options' => [ 'style' => 'display: none', 'id'=>'imageFile' . $i, 'class'=>'imageFile']])->fileInput(['multiple' => false, 'class' => 'input_image_faile', "accept"=>"image/*;capture=camera", "id"=>"open_browse" . $i]);
            $i++;
        }
    }
    echo  $form->field($model, 'imageFile[]', [ 'options' => [ 'style' => 'display: none', 'id'=>'imageFile' . $i, 'class'=>'imageFile']])->fileInput(['multiple' => false, 'class' => 'input_image_faile', "accept"=>"image/*;capture=camera", "id"=>"open_browse" . $i]);
?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'images')->hiddenInput(['value'=>$model->getAttribute('images')])->label(false)?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'issued_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'moderation')->dropDownList([ '0' => 'No', '1' => 'Yes']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
