<?php

namespace backend\controllers;

use Yii;
use backend\models\Portfolio;
use backend\models\ItemDescription;
use backend\models\Language;
use backend\models\PortfolioSearch;
use backend\models\Likes;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * PortfolioController implements the CRUD actions for Portfolio model.
 */
class PortfolioController extends Controller
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
     *  This method is invoked right before an action is executed.
     * @param string $action 
     * @return mixed
    */
    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * Lists all Portfolio models.
     * @return mixed
    */
    public function actionIndex()
    {
        $searchModel = new PortfolioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all works for one user
     * @param integer $id
     * @return mixed
     */
    public function actionUsersportfolio($id)
    {
        echo $id;
        die;
        $searchModel = new PortfolioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all works for one user
     * @param integer $id
     * @return mixed
     */
    public function actionNewworks()
    {
        $searchModel = new PortfolioSearch();

        $dataProvider = $searchModel->search(['PortfolioSearch'=>['moderation'=>0]]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Portfolio model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        //$ItemDescription=$model->itemDescription[0];
        //echo "<pre>";
        //var_dump($model);
        //echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
        //var_dump($ItemDescription);
        //die;
        $model->realikes=Likes::Reallikes($id, 2);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Portfolio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $languagearray=ArrayHelper::map(Language::find()->all(), 'id', 'url');
        $ItemDescription=[];
        if(Yii::$app->request->post('item_id')){
            $model = $this->findModel(Yii::$app->request->post('item_id'));
        }
        elseif(Yii::$app->request->post()){
            $model = new Portfolio();
            $cnt=0;
            $model->date=floor(microtime(true));
            foreach($languagearray as $key=>$value){
                $portfolio=new ItemDescription();
                $portfolio->setAttribute('language', $value);
                $temp_var['ItemDescription']=Yii::$app->request->post('ItemDescription')[$cnt];
                $portfolio->load($temp_var);
                array_push($ItemDescription,   $portfolio);
                $cnt++;
            }
        }
        else{
            $model = new Portfolio();
            $model->date=floor(microtime(true));
            foreach($languagearray as $key=>$value){
                $portfolio=new ItemDescription();
                $portfolio->setAttribute('language', $value);
                array_push($ItemDescription,   $portfolio);
            }
        }

        if($model->load(Yii::$app->request->post())){

            $model->image_uppload=UploadedFile::getInstances($model, 'image_uppload');

//            var_dump($pathToMedia);
//            die;
            $model->upload();
            $model->image_uppload = null;

            if ($model->save()) {

                if(Yii::$app->request->post('item_id')){
                    $model_description=$model->itemDescription;
                }
                else{
                    $model_description=$ItemDescription;
                }

                foreach($model_description as $k=>$v){
                    $v->link('portfolio', $model);

                    if($v->load($temp_var) && $v->save()){
                       continue;
                    }
                    else {
                        return $this->render('create', [
                            'model' => $model,
                            'ItemDescription'=>'$ItemDescription'
                        ]);
                    }
                }
                return $this->redirect(['view', 'id' => $model->item_id]);
            }else{
                return $this->render('create', [
                    'model' => $model,
                    'ItemDescription'=>$ItemDescription
                ]);
            }
        }
        else{
                return $this->render('create', [
                    'model' => $model,
                    'ItemDescription'=>$ItemDescription
                ]);
        }

    }

    /**
     * Updates an existing Portfolio model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
    */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())){
            $model->image_uppload=UploadedFile::getInstances($model, 'image_uppload');

            $model->upload();
            $model->image_uppload = null;


            //$model->upload();

            if ($model->save()){
                foreach ($model->itemDescription as $key => $value) {
                    $temp_var['ItemDescription']=Yii::$app->request->post('ItemDescription')[$key];
                    if($value->load($temp_var) && $value->save()){
                       continue;
                    }
                    else {
                        return $this->render('update', [
                            'model' => $model,
                        ]);
                    }
                }
                return $this->redirect(['view', 'id' => $model->item_id]);
            }else{
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
        else{
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Portfolio model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model= $this->findModel($id);
        $model->delete();

        //delete all fields from itemDescription table
        foreach ($model->itemDescription as $key => $value) {
            $value->delete();
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Portfolio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Portfolio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Portfolio::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionChange(){
        $model= $this->findModel($_POST['id']);
        $model->setAttribute('moderation',$_POST['status']); 
        $model->save(); 
        die;
        
        
    }
}
