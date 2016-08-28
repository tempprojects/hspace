<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ProfileReviews */

$this->title = 'Create Profile Reviews';
$this->params['breadcrumbs'][] = ['label' => 'Profile Reviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-reviews-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'create'=>true
    ]) ?>

</div>
