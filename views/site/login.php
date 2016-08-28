<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>Admin</b>LTE</a>
        </div><!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>
                
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            
            <?= $form->field($model, 'username', ['options'=>[
                    'tag'=>'div',
                    'class' =>'form-group has-feedback field-loginform-username required'
                    ],
                    'template'=>'{input}<span class="glyphicon glyphicon-user form-control-feedback"></span>
                    {error}{hint}'
            ])->textInput(['placeholder'=>'Username']) ?>
            
            <?= $form->field($model, 'password',['options'=>[
                        'tag'=>'div',
                        'class' =>'form-group has-feedback field-loginform-password required'
                        ],
                        'template'=>'{input}<span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        {error}{hint}'
                    ])->passwordInput(['placeholder'=>'Password']) ?>
            
            <div class="row">
                <div class="col-xs-8">
                    <?=
                        $form->field($model, 'rememberMe')->checkbox(['class'=>'checkbox']); 
                    ?>
                </div>
            
            <div class="col-xs-4">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
            
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
