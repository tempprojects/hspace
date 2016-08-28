<?php

namespace backend\controllers;

use Yii;
use backend\models\ProfileReviews;
use backend\models\ProfileReviewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\Action;

/**
 * ProfileReviewsController implements the CRUD actions for ProfileReviews model.
 */
class ProfileReviewsController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' =>Action::controllerRules(Yii::$app->controller->id) 
            ],
        ];
    }

    /**
     * Lists all ProfileReviews models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProfileReviewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    /**
    * Lists all ProfileReviews that cureent user sand.
    * @param integer $id user
    * @return mixed
    */
    public function actionUserreviews($id)
    {
        $searchModel = new ProfileReviewsSearch();
        $dataProvider = $searchModel->search(['ProfileReviewsSearch'=>['from'=>$id]]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
    * Lists all ProfileReviews for cureent user.
    * @param integer $id user
    * @return mixed
    */
    public function actionUserprofilereviews($id)
    {
        $searchModel = new ProfileReviewsSearch();
        $dataProvider = $searchModel->search(['ProfileReviewsSearch'=>['to'=>$id]]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProfileReviews model.
     * If update is successful, the browser will be redirected to the 'view' page.
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
     * Creates a new ProfileReviews model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
    */
    public function actionCreate()
    {
        $model = new ProfileReviews();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ProfileReviews model.
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
     * Deletes an existing ProfileReviews model.
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
     * Finds the ProfileReviews model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProfileReviews the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProfileReviews::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
