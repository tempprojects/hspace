<?php
 
use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\PortfolioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->registerJsFile('@web/js/checkbox.js',['depends' => [\yii\web\JqueryAsset::className()]]);
$this->title = 'Portfolios';
$this->params['breadcrumbs'][] = $this->title;

//$putb = Yii::$app->urlManagerBase->createUrl('media/portfolio/'.$value);
$putb = Yii::$app->urlManagerBase->createUrl("");
?>

<script>
    
   var putb = "<?php echo $putb ?>";

</script>
<div class="portfolio-index">

    <h1>Portfolio works</h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <p>
        <?= Html::a('Create new work', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'item_id',
            [   'attribute'=>'owner_id',
                'format' => 'raw',
                'label' => 'User',
                'value' => function($model) {
                    $result='';

                    if(is_object($model->users)){
                         $result.= Html::a (Html::img(Yii::$app->urlManagerFrontEnd->createUrl("media/profile/avatar/" . $model->users->getAttribute('avatar')),[
                        'alt'=>'',
                        'class' => 'index_avatar'
                        ]) , Yii::$app->getUrlManager()->getBaseUrl() . '/users/view/'. $model->getAttribute('owner_id'), ['style' => ' display:inline-block;']);
                        $result.= Html::a ( $model->users->getAttribute('username'), Yii::$app->getUrlManager()->getBaseUrl() . '/users/view/'. $model->getAttribute('owner_id'), ['class' => 'a_index']);
                    }
                   return $result;
                }
            ],
            [
                'label' => 'Images',
                'format' => 'raw',
                'value' => function($data){
                    $result="";
                    $array_images=explode("|", $data->images);
                    foreach ($array_images as $value) {
                        if ($value) {
                            $result.=Html::img(Yii::$app->urlManagerFrontEnd->createUrl('media/portfolio/'.$value),[
                                'alt'=>'',
                                'style' => 'width:100px;'
                            ]);
                        }
                    }
                    return $result;
                },
            ],
            'status',
            [
                'attribute'=>'date',
                'label' => 'Date',
                'value' => function($model) {
                    return date("h:i a m.d.Y", $model->date);
                }
            ],

            [
                'label' => 'moderation',
                'format' => 'raw',
                'value' => function($data){
                   
                  $result=Html::checkbox('name', $data->moderation ? true : false, ['data' => ['id' => $data->item_id , 'name' => 'yii']] );                   
                    return $result;
                },
            ],
           
            [
                'format' => 'raw',
                'label' => 'Link to work',
                'value' => function($model) {
                    return Html::a ( "Go!", Yii::$app->urlManagerBase->createUrl('/account/portfolio/item?id='. $model->item_id));
                }
            ],
            'likes',
            'views',
            // 'group_id',
            // 'date',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}{delete}',
                'contentOptions' =>['class' => 'table_buttons'],
            ],
        ],
    ]); ?>
</div>

