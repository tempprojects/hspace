<?php

namespace backend\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "publicity".
 *
 * @property integer $id
 * @property string $title
 * @property string $link
 * @property string $image
 * @property string $description
 * @property integer $position
 * @property integer $status
 * @property integer $country_id
 */
class Publicity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
    */
    public $imageFile;
    //upload directory path
    public $image_upload_directory="";

    //Construcor for current model
    // Here we seting parameter of path to the uplaod image directory
    public function __construct() {
        parent::__construct();
        $pathToFrontend=\Yii::getAlias('@frontend');
        $this->image_upload_directory= $pathToFrontend . "/web/media/banners";
    }

    public static function tableName()
    {
        return 'publicity';
    }

    /**
     * @inheritdoc
    */
    public function rules()
    {
        return [
            [['title', 'image'], 'required'],
            [['description', 'role', 'video'], 'string'],
            [['position', 'status','country_id'], 'integer'],
            [['title', 'link', 'image'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],

        ];
    }

    /**
     * @inheritdoc
    */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'link' => 'Link',
            'image' => 'Image',
            'description' => 'Description',
            'position' => 'Position',
            'status' => 'Status',
            'imageFile'=>'Publicity image',
            'role' => 'Role',
            'video' => 'Video link',
            'country_id' =>'Country',
        ];
    }

    /**
        * Save all image files in the same position numver
        *
        * @param string $pathToUploadDir path to save folder
        * @return (true|false)
    */
    public function createpublicity()
    {
        $this->imageFile = UploadedFile::getInstance($this, 'imageFile');
        if($this->imageFile && $this->validate()){
            $base_name_add=floor(microtime(true));
            $this->imageFile->saveAs($this->image_upload_directory . '/' . $base_name_add . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            $this->image = $base_name_add . $this->imageFile->baseName . '.' . $this->imageFile->extension;
        }
        $this->imageFile = null;
        if ($this->save()) {
            return TRUE;
        }
    }

    public function upload()
    {
        if ($this->validate()) {
            $base_name_add=floor(microtime(true));
            $this->imageFile->saveAs($this->image_upload_directory . '/' . $base_name_add . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            $this->setAttribute('image', $base_name_add . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        }else{
           return false;
        }
    }

    /**
        * Deletin image of the publicity
        * @return true|fasle
    */
    public function beforeDelete()
    {
        //delete user`s image
        if(file_exists( $this->image_upload_directory . '/' . $this->getAttribute('image'))){
            unlink( $this->image_upload_directory . '/' . $this->getAttribute('image'));
        }
        return true;
    }
}
