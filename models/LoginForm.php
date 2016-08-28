<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\LoginForm as CommonLoginForm;

/**
 * Login form
 */
class LoginForm extends CommonLoginForm
{
    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
    */
    public function backendLogin()
    {
        $backendRoles=\backend\models\Action::controllerRoles('backend', 'backend');
        if ($this->validate() && in_array($this->getUser()->role, $backendRoles)) {

            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }
    
}
