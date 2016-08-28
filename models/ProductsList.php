<?php

namespace backend\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "products_list".
 *
 * @property integer $id_prod
 * @property integer $user_id
 * @property string $product_name
 * @property string $meta_tags
 * @property string $price
 * @property string $images
 * @property string $main_image
 * @property string $miniature_img
 * @property string $prod_desc
 * @property integer $likes
 * @property integer $views
 * @property integer $id_catalog
 * @property integer $stock
 */
class ProductsList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $imageFile;


    public $image_upload_directory="";

    public function __construct() {
        parent::__construct();
        $pathToFrontend=\Yii::getAlias('@frontend');
        $this->image_upload_directory= $pathToFrontend . "/web/media/products";
    }

    public static function tableName()
    {
        return 'products_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'id_catalog', 'stock'], 'integer'],
            [['product_name', 'meta_tags', 'price',  'prod_desc', 'id_catalog'], 'required'],
            [['price'], 'number'],
            [['prod_desc'], 'string'],
            [['product_name', 'meta_tags',  'main_image', ], 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'product_name' => 'Product name',
            'meta_tags' => 'Meta Tags',
            'price' => 'Price',
            'images' => 'Images',
            'main_image' => 'Main Image',
            'miniature_img' => 'Miniature Img',
            'prod_desc' => 'Description',
            'id_catalog' => 'Catalog',
            'stock' => 'Stock',
        ];
    }

    public function createproduct()
    {
        $this->imageFile = UploadedFile::getInstance($this, 'imageFile');
        if($this->imageFile && $this->validate()){
            $base_name_add=floor(microtime(true));
            $this->imageFile->saveAs($this->image_upload_directory . '/' . $base_name_add . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            $this->main_image = $base_name_add . $this->imageFile->baseName . '.' . $this->imageFile->extension;
        }
        $this->imageFile = null;

        if ($this->save()) {
            return TRUE;
        }
    }

    public function upload()
    {
        //print_r($this);die;
        if ($this->validate()) {
            $base_name_add=floor(microtime(true));
            $this->imageFile->saveAs($this->image_upload_directory . '/' . $base_name_add . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            $this->setAttribute('main_image', $base_name_add . $this->imageFile->baseName . '.' . $this->imageFile->extension);
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
        if(file_exists( $this->image_upload_directory . '/' . $this->getAttribute('main_image'))){
            unlink( $this->image_upload_directory . '/' . $this->getAttribute('main_image'));
        }
        return true;
    }
}