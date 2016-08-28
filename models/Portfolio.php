<?php

namespace backend\models;

use Yii;
use backend\models\ItemDescription;
use yii\web\UploadedFile;
use yii\helpers\Html;
use yii\db\Query;
/**
 * This is the model class for table "portfolio".
 *
 * @property integer $item_id
 * @property integer $owner_id
 * @property string $images
 * @property integer $moderation
 * @property integer $status
 * @property integer $likes
 * @property integer $views
 * @property integer $group_id
 * @property integer $date
 */

class Portfolio extends \yii\db\ActiveRecord
{
    public $image_uppload;

    //Real count likes fo current portfolio
    public $realikes=0;

    //upload directory path
    public $image_upload_directory="";
    
    
    //Construcor for current model
    // Here we seting parameter of path to the uplaod image directory
    public function __construct() {
        parent::__construct();
        
        $pathToFrontend=\Yii::getAlias('@frontend');
        $this->image_upload_directory= $pathToFrontend . "/web/media/portfolio";
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'portfolio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['owner_id', 'images', 'group_id'], 'required'],
            [['owner_id', 'moderation', 'status', 'likes', 'style_id','views', 'group_id', 'date'], 'integer'],
            [['images'], 'string', 'max' => 255],
            [['image_uppload'],   'file', 'maxFiles' => 3,  'extensions' => 'gif, jpg, png'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_id' => 'Item ID',
            'owner_id' => 'Owner ID',
            'images' => 'Images',
            'moderation' => 'Moderation',
            'status' => 'Status',
            'style_id'=> 'Style id',
            'likes' => 'Likes',
            'views' => 'Views',
            'group_id' => 'Group ID',
            'date' => 'Date',
            'image_uppload'=>'Images'
        ];
    }

    //Rull connection to ItemDescription model(table)
    public function getItemDescription()
    {
        return $this->hasMany(ItemDescription::className(), ['item_id' => 'item_id']);
    }

    //Rull connection to User model(table)
    public function getUsers()
    {
        return $this->hasOne(Users::className(), ['id' => 'owner_id']);
    }

    //Rull connection to Likes model(table) and return count of likes for current portfolio
//    public function getLikes()
//    {
//        return $this->hasMany(Users::className(), ['id' => 'object_id'])->count();
//    }

    /**
     * Save all image files in the same position numver
     *
     * @return (true|false)
    */
    public function upload()
    {
        $prev_images_arr=explode("|", $this->getAttribute('images'));
        //var_dump($prev_images_arr);
        //die;
        //var_dump($pathToUploadDir);
        //var_dump($prev_images_arr);
        //var_dump($this->image_uppload);

        if($this->validate()){
            foreach ($this->image_uppload as $file) {
                //var_dump($file);
                $index_of_image = array_search($file->baseName . '.' . $file->extension , $prev_images_arr);
                $base_name_add=floor(microtime(true));
                if(!is_null($index_of_image)){
                    $prev_images_arr[$index_of_image]=$base_name_add . $file->baseName . '.' . $file->extension;
                    $save = $file->saveAs( $this->image_upload_directory . '/' . $base_name_add . $file->baseName . '.' . $file->extension);
                }
            }
            $this->setAttribute('images', implode("|", $prev_images_arr));
            return true;
        }else{
            return false;
        }
    }

    /**
     * Create html tags for display image in DetailView widget
     * @return string
    */
    public function imagesForDetailView(){
        $result=" ";
        $array_images=explode("|", $this->getAttribute('images'));
        foreach ($array_images as $value) {
            if ($value) {
                $result.=Html::img(Yii::$app->urlManagerFrontEnd->createUrl('media/portfolio/'.$value),[
                    'alt'=>'',
                    'style' => 'width:250px;'
                ]);
            }
        }
        return  $result;
    }

    /**
     * Deletin all related table before deleting portfolio
     * @return string
    */
    public function beforeDelete()
    {
        $prev_images_arr=explode("|", $this->getAttribute('images'));
        foreach ($prev_images_arr as $file) {
            if($file && $file!=" "){
                if(file_exists( $this->image_upload_directory . '/' . $file)){
                    unlink( $this->image_upload_directory . '/' . $file);
                }
            }
        }
        foreach ($this->itemDescription as $item){
            $item->delete();
        }
        return true;
    }
}
