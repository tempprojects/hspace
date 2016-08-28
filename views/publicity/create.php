<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Publicity */

$this->title = 'Create Publicity';
$this->params['breadcrumbs'][] = ['label' => 'Publicities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publicity-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
