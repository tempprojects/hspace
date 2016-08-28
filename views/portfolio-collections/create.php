<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PortfolioCollections */

$this->title = 'Create Portfolio Collections';
$this->params['breadcrumbs'][] = ['label' => 'Portfolio Collections', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="portfolio-collections-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
