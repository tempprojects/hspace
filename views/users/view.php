<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = 'User id: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => (isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER']:(['index']))];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">
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
    <p>
        <?= Html::a('User\'s portfolio', ['portfolio/usersportfolio', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('User\'s portfolio collections', ['portfolio-collections/userclollections', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('User\'s honours', ['user-honours/usershonours', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('User\'s videos', ['user-videos/usersvideos', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Reviews of user profile ', ['profile-reviews/userprofilereviews', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('User\'s reviews', ['profile-reviews/userreviews', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Avatar',
                'format' => 'raw',
                'value' => $model->avatar? Html::img(Yii::$app->urlManagerFrontEnd->createUrl('media/profile/avatar/'. $model->avatar),[
                            'alt'=>'',
                            'style' => 'width:250px;'
                        ]): "",
                'visible'=>true
            ],
            'id',
            'username',
            'auth_key',
            'password_hash',
            'account_activation_token',
            'password_reset_token',
            'email:email',
            'first_name',
            'last_name',
            'city',
            [
                'label' => 'Country',
                'value' => $model->current_country_name,
            ],
            'roles',
            [
                'label' => 'Activation Status',
                'value' => $model->current_status_name,
            ],
            'paid_status',
             [
                'label' => 'Created date',
                'format' => 'raw',
                'value' =>  $model->getAttribute('created_at') ? date("h:i a m.d.Y", $model->getAttribute('created_at')):" ",
                'visible'=>true
            ],
             [
                'label' => 'Updated date',
                'format' => 'raw',
                'value' =>  $model->getAttribute('updated_at') ? date("h:i a m.d.Y", $model->getAttribute('updated_at')):" ",
                'visible'=>true
            ],
            'likes',
            [
                'label' => 'Real Likes',
                'format' => 'raw',
                'value' => $model->realikes,
                'visible' => true
            ],
            'background',
            'specialization',
            'message',
            'link_user_site',
            'link_linkedin',
            'link_tumblr',
            'link_fb',
            'link_tw',
            'link_inst',
            'link_behance',
            'link_google',
            'link_pint',
            'link_blg'
        ],
    ]) ?>
    <?php
    //Video of current user
//    if($model->videos){
//        echo "<br><h1>Videos of current user:</h1>";
//        foreach($model->videos as $key => $value){
//            echo "<h3>" . $value->getAttribute('name') . "</h3>";
//            echo DetailView::widget([
//                'model' => $value,
//                'attributes' => [
//                    [
//                        'label' => 'Video',
//                        'format' => 'raw',
//                        'value' =>  "<iframe width='560' height='315' src='" . $value->getAttribute('link') . "' frameborder='0' allowfullscreen></iframe>",
//                        'visible'=>true
//                    ],
//                ],
//             ]);
//        }
//    }
    ?>
</div>
