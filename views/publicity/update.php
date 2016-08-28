<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Publicity */

$this->title = 'Update Publicity: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Publicities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="publicity-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
