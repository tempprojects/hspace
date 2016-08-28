<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\UserLicenses */

$this->title = 'Create User Licenses';
$this->params['breadcrumbs'][] = ['label' => 'User Licenses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-licenses-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
