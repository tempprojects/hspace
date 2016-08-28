<?php

namespace backend\controllers;

use Yii;
use backend\models\UserHonours;
use backend\models\UserHonoursSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserHonoursController implements the CRUD actions for UserHonours model.
 */
class UserHonoursController extends Controller
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
     * Lists all UserHonours models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserHonoursSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    

    /**
     * Displays a single UserHonours model.
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
     * Creates a new UserHonours model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserHonours();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserHonours model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UserHonours model.
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
    * Select all non moderated honours
    * @return mixed
    */
    public function actionNewhonours()
    {
        $post_result=Yii::$app->request->queryParams;
        $post_result['UserHonoursSearch']['moderation']=0;
        $searchModel = new UserHonoursSearch();
        $dataProvider = $searchModel->search($post_result);
        $dataProvider->pagination->pageSize=10;

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel'=> $searchModel,
        ]);
    }

    /**
     * Finds the UserHonours model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserHonours the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserHonours::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
     /**
     * Lists all honours for one user
     * @param integer $id
     * @return mixed
     */
    public function actionUsershonours($id)
    {
        $searchModel = new UserHonoursSearch();
        $post_result['UserHonoursSearch']['user_id']=$id;
        $dataProvider = $searchModel->search($post_result);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
