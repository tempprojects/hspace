<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\account\models\Catalog;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\ProductsList */
/* @var $form yii\widgets\ActiveForm */

//add scropt for dropzone
$this->registerJsFile('@web/js/productsListForm.js',['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<?php
$status = array(0,1);
$catalog = Catalog::find()->asArray()->all();
?>
<div class="products-list-form">
   <div class="form_create_left">

       <p><b>Main image</b></p>
       <div class="row">
           <div class="dropzone" id="dropzone0"></div>
       </div>

       <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

       <?= $form->field($model, 'imageFile', ['options' => ['style' => 'display: none']])->fileInput(['multiple' => false, 'class' => 'input_image_faile', "accept" => "image/*;capture=camera", "id" => "open_browse0"]) ?>

       <?= $form->field($model, 'user_id')->hiddenInput(['value' => 0])->label(false) ?>

       <?= $form->field($model, 'product_name')->textInput(['maxlength' => true, 'style' => 'width:32.4%;']) ?>

       <?= $form->field($model, 'meta_tags')->textInput(['maxlength' => true, 'style' => 'width:32.4%;'])->label('Meta Tags (tag, tag... )') ?>

       <?= $form->field($model, 'main_image')->hiddenInput(['value' => $model->getAttribute('main_image')])->label(false) ?>

    </div>
    <div class="form_create_right">

        <?= $form->field($model, 'prod_desc')->textarea(['rows' => 6, 'style' => 'width:32.4%;']) ?>

        <?= $form->field($model, 'price')->textInput(['maxlength' => true, 'style' => 'width:32.4%;']) ?>

        <?= $form->field($model, 'id_catalog')->dropDownList(ArrayHelper::map($catalog, 'id_catalog', 'title'), ['prompt' => 'Select catalog', 'style' => 'width:32.4%;']) ?>

        <?= $form->field($model, 'stock')->dropDownList($status,['style' => 'width:32.4%;']) ?>

    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
