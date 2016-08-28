<?php
namespace backend\controllers;

use Yii;
use backend\models\ActionSearch;
use backend\models\Rules;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Action;

/**
 * ActionController implements the CRUD actions for Action model.
 */
class ActionController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' =>\backend\models\Action::controllerRules(Yii::$app->controller->id) 
            ],
        ];
    }

    /**
     * Lists all Actions for selected role.
     * @param string $id
     * @return mixed
     */
    public function actionRolerules($id)
    {   if($id){
            Action::$role = $id;
            $searchModel = new ActionSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('rolerules', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'role'=>$id
            ]);
        }
        
       return $this->redirect('/action/index',302);
    }
    
    /**
     * Change status of rule for current role
     * @return mixed
    */
    public function actionChangestatusrule()
    {
        $result=[];
        if(isset($_POST['id']) && isset($_POST['role']) && $_POST['role'] && $_POST['id']){
            
          
            $query_result=Rules::find()->where(['action_id'=>$_POST['id']])->andWhere(['name_auth'=>$_POST['role']])->one();
            if($query_result){
                $query_result->setAttribute('status', (isset($_POST['status']) && $_POST['status'])?$_POST['status']:0);
                $save_model = $query_result->save();
            }
            else{
                $model = new Rules();
                $model->action_id= $_POST['id'];
                $model->name_auth= $_POST['role'];
                $model->status = (isset($_POST['status']) && $_POST['status'])?$_POST['status']:0;
                $save_model = $model->save();
            }

            //check if current access is to all backend 
            $actionModel = $this->findModel($_POST['id']);
            if($actionModel){
                if($actionModel->getAttribute('action')=="backend" && $actionModel->getAttribute('controller')=="backend"){

                    $myfile = fopen(dirname(__DIR__).'/config/access-roles.php', "w") or die("Unable to open file!");
                    $allroles=Action::controllerRoles('backend', 'backend');
                    $result_text="<?php return array(";

                    foreach ($allroles as $value){
                        $result_text .= "'" . $value . "', ";
                    }

                    $result_text .= ")?>";
                    fwrite($myfile, $result_text);
                    fclose($myfile);
                }
            }
            $result=['result'=>true, 'message'=>$save_model]; 
        }
        else{
           $result=['result'=>false, 'message'=>'not enough parameters'];
        }
        echo json_encode($result);
        die;
    }

    /**
     * Lists all Action models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Action model.
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
     * Creates a new Action model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Action();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }else{
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Action model.
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
     * Deletes an existing Action model.
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
     * Finds the Action model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Action the loaded model
     * @throws NotFoundHttpException if the model cannot be found
    */
    protected function findModel($id)
    {
        if (($model = Action::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
