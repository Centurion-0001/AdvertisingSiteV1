<?php


namespace app\models;

use Yii;
use yii\base\model;
use app\models\Advertising;
use yii\db\StaleObjectException;
use yii\db\ActiveRecord;
class ModelAdvertising extends Model
{
    public $title;
    public $description;


    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['title'], 'string', 'min' => 1,'max'=>100],
            [['description'], 'string', 'min'=>1, 'max'=>500],

        ];
    }
    public function Add()
    {
        if ($this->validate()) {

            $date = date('Y-m-d G:i:s');
            $id = Yii::$app->user->identity->getId();
            $advertising = new Advertising();
            $advertising->title = $this->title;
            $advertising->description = $this->description;
            $advertising->datetime = $date;
            $advertising->id_user = $id;
            $advertising->save();
            return true;
        }


    }
    public function DeleteItem($id)
    {

        $connection = Yii::$app->db;
       $command = $connection->createCommand('Delete from advertising where id=:id');
       $command->bindParam(':id', $id);
       $command->execute();

    }
    public function Update($id)
    {
        if ($this->validate()) {

            $connection = Yii::$app->db;
            $date = date('Y-m-d G:i:s');
            $command = $connection->createCommand('UPDATE advertising SET title =:title,description =:description,datetime=:datetime WHERE id=:id');
            $command->bindParam(':id', $id);
            $command->bindParam(':title', $this->title);
            $command->bindParam(':description', $this->description);
            $command->bindParam(':datetime', $date);
            $command->execute();
            return true;
        }
    }
}