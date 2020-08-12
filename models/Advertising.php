<?php


namespace app\models;
use yii\db\ActiveRecord;
use app\models\User;
class Advertising extends ActiveRecord
{

    private $title;
    private $description;
    private $datetime;
    private $id_user;
    private $id;


    public function getUser()
    {
        return $this->hasMany(User::class,['id'=>'id_user']);
    }

}
