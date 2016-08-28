<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Publicity */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Publicities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publicity-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
<?php $position = array( 'top_right.jpg', 'top_left.jpg', 'bottom_right.jpg', 'centre_right.jpg','bottom.jpg');?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Image',
                'format' => 'raw',
                'value' => $model->image ? Html::img(Yii::$app->urlManagerFrontEnd->createUrl('media/banners/'. $model->image),[
                            'alt'=>'',
                            'style' => 'width:250px;'
                        ]): " ",
                'visible'=>true
            ],
            //'id',
            'title',
            'link',
            //'image',
            'description:ntext',
//            [                      // name свойство зависимой модели owner
//                'label' => 'Owner',
//                'value' => $model->owner->name,
//            ],
//            [
//                'label' => 'Position',
//                'format' => 'raw',
//                'value' => Html::img(Yii::$app->urlManagerFrontEnd->createUrl('media/banners/'.$position[$data->position]),
//                        [ 'alt'=>'','style' => 'width:120px;' ]),
//                'visible'=>true
//            ],
            'position',
            'status',
            'role',
            'video'
        ],
    ]) ?>

</div>
