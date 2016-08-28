<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model backend\models\Portfolio */
/* @var $form yii\widgets\ActiveForm */

    //Script for ci\urrent form
    $this->registerJsFile('@web/js/portfolioForm.js',['depends' => [\yii\web\JqueryAsset::className()]]);
?>


<div class="portfolio-form">

    <div class="row">
        <h4 class="promote drop"></h4>
        <div class="dropzone" id="dropzone0"></div>
	<div class="dropzone" id="dropzone1"></div>
	<div class="dropzone" id="dropzone2"></div>
    </div>

    
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
   
    <?= $form->field($model, 'image_uppload[0]', [ 'options' => [ 'style' => 'display: none']])->fileInput(['multiple' => false, 'class' => 'input_image_faile', "accept"=>"image/*;capture=camera", "id"=>"open_browse0"]) ?>
    <?= $form->field($model, 'image_uppload[1]', [ 'options' => [ 'style' => 'display: none']])->fileInput(['multiple' => false, 'class' => 'input_image_faile', "accept"=>"image/*;capture=camera", "id"=>"open_browse1"]) ?>
    <?= $form->field($model, 'image_uppload[2]', [ 'options' => [ 'style' => 'display: none']])->fileInput(['multiple' => false, 'class' => 'input_image_faile', "accept"=>"image/*;capture=camera", "id"=>"open_browse2"]) ?>
    
    <?= $form->field($model, 'images' )->hiddenInput(['value'=>$model->getAttribute('images')])->label(false) ?>
    
    <?= $form->field($model, 'owner_id')->textInput() ?>

    <?= $form->field($model, 'moderation')->dropDownList([ '0' => 'No', '1' => 'Yes'])?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'style_id')->textInput() ?>

    <?= $form->field($model, 'likes')->textInput() ?>

    <?= $form->field($model, 'views')->textInput() ?>

    <?= $form->field($model, 'group_id')->textInput() ?>

    <?php //echo $form->field($model, 'date')->textInput() ?>
    
    <?= $form->field($model, 'item_id')->hiddenInput(['value'=>$model->getAttribute('item_id')])->label(false); ?>

    <?php
     
    if( $model->itemDescription){
       $itemDescription=$model->itemDescription;
    }
    else{
       $itemDescription=$ItemDescription;
    }
    
    foreach($itemDescription as $key => $value){
        echo "<br><h1>Language: '" . $itemDescription[$key]->getAttribute('language') . "'</h1>";
        echo $form->field($value, '[' . $key . ']title')->textInput();
        echo $form->field($value, '[' . $key . ']description')->widget(CKEditor::className(),[
                'editorOptions' => [
                    'preset' => 'full',
                    'inline' => false, 
            ],
        ]);
//        echo $form->field($value, '[' . $key . ']short_description')->widget(CKEditor::className(),[
//                'editorOptions' => [
//                    'preset' => 'full',
//                    'inline' => false,
//            ],
//        ]);;
        echo $form->field($value, '[' . $key . ']short_description')->textarea(['rows'=>6]);
        echo $form->field($value, '[' . $key . ']tags')->textInput();
        echo $form->field($value, '[' . $key . ']meta')->textInput();
    }
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
