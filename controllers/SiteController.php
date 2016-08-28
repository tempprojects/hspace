<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use backend\models\LoginForm;
use yii\filters\VerbFilter;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
    */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                        'roles'=>['@', '?']
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => \backend\models\Action::controllerRoles('backend', 'backend'),
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],

                ],
            ],
            // 'verbs' => [
            //     'class' => VerbFilter::className(),
            //     'actions' => [
            //         'logout' => ['post'],
            //     ],
            // ],
        ];
    }

    /**
     * @inheritdoc
    */
    public function actions()
    {
        //if current user has access backend permissions
        if(!\Yii::$app->user->isGuest){
            $all_roles = \backend\models\Action::controllerRoles('backend', 'backend');
            $current_role = \Yii::$app->user->identity->getAttribute('roles');
            
            if(in_array($current_role, $all_roles)){
                return [
                    'error' => [
                        'class' => 'yii\web\ErrorAction',
                    ],
                ];
            }
        }
        return $this->localLogin();
    }

    public function actionError()
    {
        //if current user has access backend permissions
        if(!\Yii::$app->user->isGuest){
            $all_roles = \backend\models\Action::controllerRoles('backend', 'backend');
            $current_role = \Yii::$app->user->identity->getAttribute('roles');
            
            if(in_array($current_role, $all_roles)){
                return [
                    'error' => [
                        'class' => 'yii\web\ErrorAction',
                    ],
                ];
            }
        }
        return $this->localLogin();
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {   
        return $this->localLogin();
    }


    protected function localLogin()
    {
        //return $this->render('index');
        $this->layout='LoginLayout';
        if (!\Yii::$app->user->isGuest ) {
            $all_roles = \backend\models\Action::controllerRoles('backend', 'backend');
            $current_role = \Yii::$app->user->identity->getAttribute('roles');
           
            if(in_array($current_role, $all_roles)){
                return $this->goHome();
            }
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            if(!\Yii::$app->user->isGuest)
                Yii::$app->user->logout();

                if($model->backendLogin()){
                    return $this->goBack();
                }
            
        }
        return $this->render('login', [
                'model' => $model,
        ]);
    }


    public function actionLogout()
    {
        // echo "<h1>Logout</h1>";
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
