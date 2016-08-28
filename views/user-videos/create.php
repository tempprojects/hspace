<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\UserVideos */

$this->title = 'Create User Videos';
$this->params['breadcrumbs'][] = ['label' => 'User Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-videos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
