<?php
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

<?= //print_r($model);
//die;
    $this->render('_form', [
        'model' => $model,
        'countries' => $countries,
        'roles' =>$roles,
        'statuses'=>$statuses,
        'specialization'=>$specialization
    ]) ?>

</div>
