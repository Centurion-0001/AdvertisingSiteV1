<?php
namespace app\models;
use PHPUnit\Framework\IncompleteTest;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;


class User extends ActiveRecord implements IdentityInterface{

    private $username;
    private $password;

    public static function findByUserOnUsername($username)
    {
        return self::findOne(['username' => $username]);
    }
    public static function  findByUserOnUsernameAndPassword($username,$password)
    {
        return self::findOne(['username'=>$username,'password'=>$password]);
    }



    public static function tableName()
    {
        return 'user';
    }


    public static function findIdentity($id)
    {
        return static::findOne($id);
    }


    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }


    public function getId()
    {
        return $this->id;
    }


    public function getAuthKey()
    {
        return $this->auth_key;
    }


    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

}