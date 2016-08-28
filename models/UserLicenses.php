<?php
namespace backend\models;
use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "user_licenses".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $images
 * @property string $number
 * @property string $issued_by
 * @property integer $moderation
 */
class UserLicenses extends \yii\db\ActiveRecord
{
    //Varible that contain images post data
    public $imageFile;
    //upload directory path
    public $image_upload_directory="";
    public $addtopathfile="";

    //Construcor for current model
    // Here we seting parameter of path to the uplaod image directory
    public function __construct() {
        parent::__construct();
        $pathToFrontend=\Yii::getAlias('@frontend');
        $this->image_upload_directory= $pathToFrontend . "/web/media/profile/licenses";
        $this->addtopathfile="/media/profile/licenses";
    }

    /**
    * @inheritdoc
    */
    public static function tableName()
    {
        return 'user_licenses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'images', 'number', 'issued_by'], 'required'],
            [['user_id', 'moderation'], 'integer'],
            [['images', 'number', 'issued_by'], 'string'],
            [['imageFile'],   'file', 'maxFiles' => 50,  'extensions' => 'gif, jpg, png, pdf'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'images' => 'Images',
            'number' => 'Number',
            'issued_by' => 'Issued By',
            'moderation' => 'Moderation',
            'imageFile'=>'Images'
        ];
    }

    //Rull connection to User model(table)
    public function getUsers()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /**
     * Create html tags for display image in DetailView widget
     *
     * @param string $pathToUploadDir path to save folder
     * @return string
    */
    public function imagesForDetailView(){
        $result=" ";
        $array_images=explode("|", $this->getAttribute('images'));
        foreach ($array_images as $value) {
            if ($value && $value!=" "){
                $result.=Html::img(Yii::$app->urlManagerFrontEnd->createUrl($value),[
                    'alt'=>'',
                    'style' => 'width:250px;'
                ]);
            }
        }
        return  $result;
    }

    /**
     * Save all image files in the same position numver
     *
     * @param string $pathToUploadDir path to save folder
     * @return (true|false)
    */
    public function upload()
    {
        $prev_images_arr=explode("|", $this->getAttribute('images'));
        //echo "<pre>";
        //var_dump($prev_images_arr);
        //var_dump($this->imageFile );
        //die;
        //var_dump($prev_images_arr);
        //var_dump($this->imageFile);

        if ($this->validate()) {
            foreach ($this->imageFile as $file) {
                //var_dump($file);
                $index_of_image = array_search($file->baseName . '.' . $file->extension , $prev_images_arr);
                $base_name_add=floor(microtime(true));

                if(!is_null($index_of_image)){
                    $prev_images_arr[$index_of_image]=$this->addtopathfile . '/' . $base_name_add . $file->baseName . '.' . $file->extension;
                    $save = $file->saveAs($this->image_upload_directory . '/' . $base_name_add . $file->baseName . '.' . $file->extension);
                }
            }
            $this->setAttribute('images', implode("|", $prev_images_arr));
            return true;
        } else {
            return false;
        }
    }

    /**
     * Deletin all images
     * @return string
    */
    public function beforeDelete()
    {
        $prev_images_arr=explode("|", $this->getAttribute('images'));
        foreach ($prev_images_arr as $file) {
            if($file && $file!=" "){
                if(file_exists( \Yii::getAlias('@frontend') . '/web' . $file)){
                    unlink(\Yii::getAlias('@frontend') . '/web' . $file);
                }
            }
        }
        return true;
    }
}
