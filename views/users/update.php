<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = 'Update User: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => (isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER']:(['index']))];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
        'countries' => $countries,
        'roles' =>$roles,
        'statuses'=>$statuses,
        'specialization'=>$specialization
    ]) ?>

</div>
