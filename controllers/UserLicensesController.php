<?php

namespace backend\controllers;

use Yii;
use backend\models\UserLicenses;
use backend\models\UserLicensesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UserLicensesController implements the CRUD actions for UserLicenses model.
 */
class UserLicensesController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' =>\backend\models\Action::controllerRules(Yii::$app->controller->id) 
            ],
        ];
    }
    
    /**
     *  This method is invoked right before an action is executed.
     * @param string $action 
     * @return mixed
    */
    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * Lists all UserLicenses models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserLicensesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserLicenses model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UserLicenses model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserLicenses();

        if($model->load(Yii::$app->request->post())){
            $model->imageFile=UploadedFile::getInstances($model, 'imageFile');
            
            if($model->upload()){
                $model->imageFile = null;
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
            }
            else{
                $model->setAttribute('images',  $model->getOldAttribute('images'));
                return $this->render('update', [
                        'model' => $model,
                  ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserLicenses model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
    */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if($model->load(Yii::$app->request->post())){
            $model->imageFile=UploadedFile::getInstances($model, 'imageFile');
            
            if($model->upload()){
                $model->imageFile = null;
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    return $this->render('update', [
                        'model' => $model,
                    ]);
                }
            }
            else{
                $model->setAttribute('images',  $model->getOldAttribute('images'));
                return $this->render('update', [
                        'model' => $model,
                  ]);
            }
        }
        else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UserLicenses model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
    * Select all non moderated licenses
    * @return mixed
    */
    public function actionNewlicenses()
    {
        $post_result=Yii::$app->request->queryParams;
        $post_result['UserLicensesSearch']['moderation']=0;
        $searchModel = new UserLicensesSearch();
        $dataProvider = $searchModel->search($post_result);
        $dataProvider->pagination->pageSize=10;

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel'=> $searchModel,
        ]);
    }

    /**
     * Finds the UserLicenses model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserLicenses the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserLicenses::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
