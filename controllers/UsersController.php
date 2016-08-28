<?php
namespace backend\controllers;

use Yii;
use backend\models\Users;
use backend\models\UsersSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use backend\models\Portfolio;
use backend\models\UserVideos;
use backend\models\UserHonours;
use backend\models\Likes;

/**
    * UserController implements the CRUD actions for User model.
*/
class UsersController extends Controller
{
    public function behaviors()
    {
        return [
           'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' =>\backend\models\Action::controllerRules(Yii::$app->controller->id) 
            ],
        ];
    }

    /**
        * This method is invoked right before an action is executed.
        * @param string $action 
        * @return mixed
    */
    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=5;

        foreach ($dataProvider->models as $key => $value) {
            $value->setActivationStatusName();
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel'=> $searchModel,
            'searchAction'=> 'index',
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
    */
    public function actionView($id)
    {
        $model = new Users();
        $model = $this->findModel($id);
        $model->AllCountries();
        $model->setActivationStatusName();
        $model->realikes=Likes::Reallikes($id, 3);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
    * Creates a new User model.
    * If creation is successful, the browser will be redirected to the 'view' page.
    * @return mixed
    */
    public function actionCreate()
    {
        $model = new Users();
        if ($model->load(Yii::$app->request->post()) && $model->createuser()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $countries = $model->AllCountries();
            $statuses=[ '0' => 'Inactive', '10' => 'Active'];
            $specialization=$model->AllSpecialization();

            return $this->render('create', [
                'model' => $model,
                'countries' => $countries,
                'roles' => $model->getAllRoles(),
                'statuses'=>$statuses,
                'specialization'=>$specialization
            ]);
        }
    }

    /**
    * Updates an existing User model.
    * If update is successful, the browser will be redirected to the 'view' page.
    * @param integer $id
    * @return mixed
    */
    public function actionUpdate($id)
    {
        $model = new Users();
        $model = $this->findModel($id);
        if($model->load(Yii::$app->request->post())){
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if($model->imageFile){
                $model->upload();
            }
            //$model->image_uppload = null;
            $model->imageFile = null;
            if ($model->updatePassword() &&  $model->updateAuthRole() && $model->save()) {
                   return $this->redirect(['view', 'id' => $model->id]);
            }
//                var_dump($model);
                $model->save();
//                print_r($model->getErrors());
        }

        $countries = $model->AllCountries();
        $specialization=$model->AllSpecialization();
        if($model->getAttribute('status')==50){
            $statuses=[ '0' => 'Inactive', '10' => 'Active', '50'=>'Deleted'];
        }
        else{
            $statuses=[ '0' => 'Inactive', '10' => 'Active'];
        }
        return $this->render('update', [
            'model' => $model,
            'countries' => $countries,
            'statuses' => $statuses,
            'roles' => $model->getAllRoles(),
            'specialization'=> $specialization
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if($model->getAttribute('status')==50){
            $model->delete();
            return $this->redirect(['recyclebin']);
        }
        else{
            $model->setAttribute('status', 50);
            $model->save();
            return $this->redirect(['recyclebin']);
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
    * Select all inactive users
    * @return mixed
    */
    public function actionInactive()
    {
        $post_result=Yii::$app->request->queryParams;
       
        $post_result['UsersSearch']['status']=0;
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search($post_result);
        $dataProvider->pagination->pageSize=5;

        foreach ($dataProvider->models as $key => $value) {
            $value->setActivationStatusName();
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel'=> $searchModel,
            'searchAction'=> 'inactive',
        ]);

    }

    /**
    * Select all Deletet users
    * @return mixed
    */
    public function actionRecyclebin()
    {
        $post_result=Yii::$app->request->queryParams;
       
        $post_result['UsersSearch']['status']=50;
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search($post_result);
        $dataProvider->pagination->pageSize=5;

        foreach ($dataProvider->models as $key => $value) {
            $value->setActivationStatusName();
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel'=> $searchModel,
            'searchAction'=> 'recyclebin',
        ]);
    }


    /**
    * Move selected user to recicle bin 
    * @return mixed
    */
    public function actionDeletetoreciclebin($id)
    {
        $model = new Users();
        $model = $this->findModel($id);
        $model->setAttribute('status', 50);

        $model->save(); 
        return $this->redirect(['recyclebin']);
    }
}