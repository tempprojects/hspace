<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserHonours */

$this->title = 'Update User Honours: ' . ' ' . strip_tags($model->name);
$this->params['breadcrumbs'][] = ['label' => 'User Honours', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Honour id: ' . $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-honours-update">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
