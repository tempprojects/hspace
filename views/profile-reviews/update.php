<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ProfileReviews */

$this->title = 'Update Profile Reviews: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Profile Reviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="profile-reviews-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'create'=>false
        ])
    ?>
</div>
