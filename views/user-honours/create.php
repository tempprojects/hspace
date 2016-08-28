<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\UserHonours */

$this->title = 'Create User Honours';
$this->params['breadcrumbs'][] = ['label' => 'User Honours', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-honours-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
