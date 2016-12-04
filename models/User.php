<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property string $id
 * @property string $first_name
 * @property string $lastname
 * @property string $hash_password
 * @property string $user_name
 * @property string $email
 * @property integer $status
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $password;
    public $password2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          [['first_name', 'lastname', 'hash_password', 'user_name', 'email','status'], 'required'],
          [['hash_password'], 'required', 'except' => ['hash_password']],
          [['password2'],'compare','compareAttribute'=>'hash_password'],
          [['status'], 'integer'],
          [['first_name', 'lastname', 'email'], 'string', 'max' => 128],
          [['email'],'email'],
          [['user_name'],'string','min' => 5,'max'=> 20],
          [['user_name','email'],'unique'],
          [['hash_password'], 'string', 'min'=>8,'max' => 20]
      ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'first_name' => Yii::t('app', 'Nombre'),
            'lastname' => Yii::t('app', 'Apellido'),
            'hash_password' => Yii::t('app', 'Contraseña'),
            'password2' => Yii::t('app', 'Confirmar Contraseña'),
            'user_name' => Yii::t('app', 'Nombre de Usuario'),
            'email' => Yii::t('app', 'Correo Electrónico'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            if($this->isNewRecord)
            {
                $this->hash_password = Yii::$app->getSecurity()->generatePasswordHash($this->hash_password);
                //$this->auth_key = Yii::$app->getSecurity()->generatePasswordHash($this->hash_password);
                //$this->access_token = Yii::$app->getSecurity()->generateRandomString();
            }
            else
            {
                if(!empty($this->hash_password))
                {
                    $this->hash_password = Yii::$app->getSecurity()->generatePasswordHash($this->hash_password);
                }
            }
            return true;
        }
        return false;
    }

    public static function findIdentity($id)
    {
        //return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
        return self::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by user_name
     *
     * @param  string      $user_name
     * @return static|null
     */
    public static function findByUserName($user_name)
    {
        return self::findOne(['user_name'=>$user_name]);
    }
    public static function findIdUserName($id){
        return self::findOne(['id'=>$id]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->hash_password;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        //return $this->password === $password;
        return Yii::$app->getSecurity()->validatePassword($password,$this->hash_password);
    }
}
