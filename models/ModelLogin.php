<?php


namespace app\models;
use Yii;
use yii\base\model;

class ModelLogin extends Model
{

    public $username;
    public $password;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['password'], 'string', 'min' => 1],
            [['username'], 'unique', 'targetClass' => 'app\models\User', 'targetAttribute' => 'username'],


        ];
    }
    public function login()
    {
        $user = new User();

        if ($this->validate()) {

            $check_users = $user::findByUserOnUsernameAndPassword($this->username, $this->password);
            if(isset($check_users) === true)
            {
                //user is exist;
                return Yii::$app->user->login($user::findByUserOnUsernameAndPassword($this->username, $this->password));
            }else{

                $user->username = $this->username;
                $user->password = $this->password;
                $user->save();

                Yii::$app->user->login($user);

            }

        } else{
            $check_users = $user::findByUserOnUsernameAndPassword($this->username, $this->password);
            if(isset($check_users) == true)
            {
                //user is exist;

                return Yii::$app->user->login($check_users);
            }



        }
    }

}

