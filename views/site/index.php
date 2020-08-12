<?php


/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */


use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
$this->title = '';
?>
<div class="site-index">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <?php  $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?php
                if((Yii::$app->user->isGuest) == true)
                {
                    echo "<h3 style=\"text-align: center;\">Авторизация пользователя</h3>";
                    echo "<hr  style=\"height:2px;border:none;color:#333;background-color:#333;\"/>";
                    echo "<br/>";
                    echo "<div class=\"col-md-4\"></div>";
                    echo "<div class=\"form-group col-md-4\">";
                    ?>
                   <?= $form->field($model, 'username')->textInput()?>
                   <?= $form->field($model, 'password')->passwordInput()?>

                    <?php   echo "<div class=\"container-fluid\" style=\"text-align: center;\">"; ?>
                    <?= Html::submitButton('Авторизация',['class' =>'btn btn-primary','name'=>'login-button']); ?>

            <?php
                }else{

                }

                ?>
            </div>

                </div>
                <?php ActiveForm::end(); ?>

                <div class="col-md-1"></div>

            </div>


        </div>


    <div class="row">
        <div class="col-md-1"></div>
       <div class="col-md-10" style="text-align: center;">


           <?php

           foreach($posts as $post):

                //var_dump($post['user'][0]->username);
               //  var_dump($post['id']);
               ?>
           <a href="<?= Url::toRoute(['/site/view','id' => $post['id']]);?>">
               <?php        $alldate = $post->datetime;
               $date_all = explode(' ',$alldate);
               $date_split = explode('-',$date_all[0]);
               $time = $date_all[1];
               $date = $date_split[2].'.'.$date_split[1].'.'.$date_split[0]; ?>
               <br/>
               <div style="margin-left: 10px; text-align: left; font-size: 1.4em;"><?php echo $post->title.'. '.$post['user'][0]->username.','.$date.' '.$time;?></div>
          
               <textarea class="form-control" id="exampleFormControlTextarea3" rows="5" readonly style=" border-radius: 12px; font-size: 1.3em;"><?php echo' '.$post->description;?></textarea>
           </a>

               <?php  if(Yii::$app->user->getId() == $post['user'][0]->id)
               {
                   echo "<div style=\"text-align: right; margin-top:5px;margin-right: 5px;\">"; ?>
                   <a class="a1" style="color: Green;font-size: 1.3em; margin-right: 10px;" href="<? echo Url::toRoute(['/site/edit', 'id' => $post->id]); ?>" >
                       Редактировать
                   </a>

               <?php
               echo "</div>";}
               ?>

           <?php endforeach;
           ?>

           <?= LinkPager::widget([
               'pagination' => $pages,
           ]); ?>
           </div>


    </div>



</div>

