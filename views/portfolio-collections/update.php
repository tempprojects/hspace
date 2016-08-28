<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PortfolioCollections */

$this->title = 'Update Portfolio Collections: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Portfolio Collections', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="portfolio-collections-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
