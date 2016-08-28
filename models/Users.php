<?php

namespace backend\models;

use Yii;
use common\models\User;
use yii\db\Query;
use yii\web\UploadedFile;
use backend\models\Portfolio;
use backend\models\UserVideos;
use backend\models\UserHonours;
use backend\models\UserLicenses;
use backend\models\Messages;
use backend\models\ProfileReviews;
use backend\models\PortfolioCollections;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $account_activation_token
 * @property string $password_reset_token
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property string $city
 * @property string $country
 * @property string $roles
 * @property integer $status
 * @property integer $paid_status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Users extends \common\models\User
{
    public $current_country_name="";
    public $current_status_name="";
    public $imageFile;
    //Real count likes fo current user
    public $realikes=0;
    //upload directory path
    public $image_upload_directory="";

    //Construcor for current model
    // Here we seting parameter of path to the uplaod image directory
    public function __construct(){
        parent::__construct();
        $pathToFrontend=\Yii::getAlias('@frontend');
        $this->image_upload_directory= $pathToFrontend . "/web/media/profile/avatar";
    }

    /**
     * @inheritdoc
    */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password_hash', 'email', 'roles', 'paid_status'], 'required'],
            [['roles', 'avatar', 'specialization', 'message',  'link_user_site', 'link_linkedin', 'link_tumblr', 'link_fb', 'link_tw', 'link_inst', 'link_behance', 'link_google', 'link_pint', 'link_blg'], 'string', 'max' => 255],
            [['status', 'paid_status', 'created_at', 'updated_at', 'background', 'likes'], 'integer'],
            [['username', 'password_hash', 'account_activation_token', 'password_reset_token', 'email', 'first_name', 'last_name', 'city', 'country'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 100],
            [['username'], 'unique'],
//            [['email'], 'unique'],
            [['account_activation_token'], 'unique'],
            [['password_reset_token'], 'unique'],
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
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password',
            'account_activation_token' => 'Account Activation Token',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'city' => 'City',
            'country' => 'Country',
            'roles' => 'Roles',
            'status' => 'Activation Status',
            'paid_status' => 'Paid Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'avatar' => 'Avatar',
            'background'=> 'Background',
            'specialization'=>'Specialization',
            'message'=>'About me',
            'link_user_site'=>'Link to user site',
            'link_linkedin'=>'Linkedin',
            'link_tumblr'=>'Tumblr',
            'link_fb'=> 'Facebook',
            'link_tw'=> 'Twitter',
            'link_inst'=> 'Instagram',
            'link_behance'=>'Behance',
            'link_google'=>'Google',
            'link_pint'=>'Pinterest',
            'link_blg'=>'Blogger',
            'imageFile'=>'Avatar image',
            'likes'=>'Likes'
        ];
    }
    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    // public function setPassword($password)
    // {
    //     $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    // }

    // /**
    //  * Generates "remember me" authentication key
    // */
    // public function generateAuthKey()
    // {
    //     $this->auth_key = Yii::$app->security->generateRandomString();
    // }

    // /**
    //  * Generates new password reset token
    //  */
    // public function generatePasswordResetToken()
    // {
    //     $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    // }


    /**
    * Signs user up.
    *
    * @return true|null the saved model or null if saving fails
    */
    public function createuser()
    {
        $this->setPassword($this->password_hash);
        $this->generateAuthKey();
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
        $this->created_at= floor(microtime(true));
        $this->updated_at=0;

        $this->imageFile = UploadedFile::getInstance($this, 'imageFile');
        if($this->imageFile){
            $pathToFrontend=\Yii::getAlias('@frontend');
            $this->upload($pathToFrontend . "/web/media/profile/avatar");
        }
        else{
            $this->setAttribute('avatar', 'noava.png');
        }
        //$model->image_uppload = null;
        $this->imageFile = null;

        if ($this->save()) {

            $db = Yii::$app->db;
            $sql = $db->createCommand()->insert('auth_assignment', [
                             'item_name' => $this->roles,
                             'user_id' => $this->id,
                             'created_at' => microtime(true),
                            ])->execute();
            if($sql){
                return true;
            }
        }
        return null;
    }


    /**
    * Update user password
    *
    * @return true|false saved or not
    */
    public function updatePassword()
    {
        if(strlen($this->password_hash)<40){
            if(!$this->setPassword($this->password_hash)){
                return false;
            }
        }
        return true;
    }

    /**
    * Update auth_assignment user role
    *
    * @return true|false saved or not
    */
    public function updateAuthRole()
    {
        if($this->getAttribute('roles')!=$this->getOldAttribute('roles')){
            $db = Yii::$app->db;
            $sql = $db->createCommand("UPDATE auth_assignment SET item_name=:item_name WHERE user_id=:user_id")->bindValues(array(':item_name' => $this->roles, ':user_id' => $this->id) )->execute();
            if($sql){
                return true;
            }
            return true;
        }
        else{
            return true;
        }
    }

    /**
    * Get all countries from table countries and creating associative arry ['id'=>'country_name_en']
    *
    * @return array associative array
    */
    public function AllCountries()
    {
        $query = new Query;
        $query->select('id, country_name_en')->from('country');
        $countries = $query->all();

        foreach ($countries as $key => $value){
            $result[$value['id']] = $value['country_name_en'];
        }
        if($result && $this->country){
            $this->current_country_name=$result[$this->country];
        }
        return $result;
    }

    public function AllSpecialization(){
        $query = new Query;
        $query->select('name_en')->from('specialization');
        $specialization = $query->all();

        foreach ($specialization as $key => $value){
            $result[$value['name_en']] = $value['name_en'];
        }
        return $result;
    }

    /**
    * Set  $this->current_status_name 
    *
    * @return true|false
    */
    public function setActivationStatusName()
    {
        if($this->status==10){
            $this->current_status_name="Active";
        }
        elseif($this->status==50){
            $this->current_status_name="Deleted";
        }
        else{
            $this->current_status_name="Inactive";
        }
        return $this->current_status_name;
    }

    /**
     * Save all image files in the same position numver
     * @param string $pathToUploadDir path to save folder
     * @return (true|false)
    */
    public function upload()
    {
        if ($this->validate()){
            $base_name_add=floor(microtime(true));
            $this->imageFile->saveAs($this->image_upload_directory . '/' . $base_name_add . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            $this->setAttribute('avatar', $base_name_add . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        }else{
            return false;
        }
    }

    /**
        * Deletin all relative data of user table
        * @return true|fasle
    */
    public function beforeDelete()
    {
        $id=$this->getAttribute('id');
        UserVideos::deleteAll(['user_id' => $id]);
        UserHonours::deleteAll(['user_id' => $id]);

        //delete user`s licenses
        foreach (UserLicenses::find()->where('user_id='. $id)->all() as $licenses){
            $licenses->delete();
        }

        PortfolioCollections::deleteAll(['user_id' => $id]);
        Messages::deleteAll(['from' => $id]);
        Messages::deleteAll(['to' => $id]);
        ProfileReviews::deleteAll(['to' => $id]);
        ProfileReviews::deleteAll(['from' => $id]);
        //for using triger for deleting related tables
        foreach (Portfolio::find()->where('owner_id='. $id)->all() as $portfolio) {
            $portfolio->delete();
        }
        //delete user`s avatar
        if(file_exists( $this->image_upload_directory . '/' . $this->getAttribute('avatar')) && $this->getAttribute('avatar')!="noava.png"){
            unlink( $this->image_upload_directory . '/' . $this->getAttribute('avatar'));
        }
        return true;
    }

    /**
        * Get all Roles and roles description
        * @return array
    */
    public function getAllRoles(){
        $query = new Query;
        $query->select('name, description_en')->from('auth_item')->where(['type' => 1]);
        $roles = $query->all();

        $result = array_column($roles, 'name', 'name');
        return $result;
    }
}