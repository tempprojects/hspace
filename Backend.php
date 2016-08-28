<?php
namespace backend;

use Yii;

class Account extends \yii\base\Module
{
    public $controllerNamespace = 'backend\controllers';

    public function init()
    {
        // if (Yii::$app->user->isGuest) 
        // {
        //  return Yii::$app->getResponse()->redirect(array('/site/index'));
        // }

        parent::init();
    }

}