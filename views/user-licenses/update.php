<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserLicenses */

$this->title = 'Update User Licenses: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Licenses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'License id: ' . $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-licenses-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
