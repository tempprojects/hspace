<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Translation */
    $this->title = 'Update Translation slug: ' . ' ' . $model->slug;
    $this->params['breadcrumbs'][] = ['label' => 'Translations', 'url' => ['index']];
    $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
    $this->params['breadcrumbs'][] = 'Update';
?>
<div class="translation-update">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'slug'=>$slug
    ]) ?>
</div>
