<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>

<div class="site">
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <h4 style="margin-left: 10px;">  <?php echo $res_query[0]['username'];?>,<?php

                $alldate = $res_query[0]['datetime'];
                $date_all = explode(' ',$alldate);
                $date_split = explode('-',$date_all[0]);
                $time = $date_all[1];
                $date = $date_split[2].'.'.$date_split[1].'.'.$date_split[0];
                echo $date.' '.$time;
                ?> </h4>
            <h3 style="margin-left: 10px;"><?php echo $res_query[0]['title'];?></h3>
    <textarea class="form-control" id="exampleFormControlTextarea3" rows="12" readonly style=" border-radius: 12px;font-size: 1.3em;"><?php echo' '.$res_query[0]['description'];?></textarea>
       <?php
        if($res_query[0]['user_id'] == Yii::$app->user->identity->getId())
        {

            ?>
            <div style="text-align: right; margin-top: 10px; margin-right: 5px;">
                <a class="a1" style="color: Green;font-size: 1.2em; margin-right: 10px;" href="<? echo Url::toRoute(['/site/edit', 'id' => $res_query[0]['id']]) ?>">
                    Редактировать
                </a>
                <a  class="a2" style=" color: Red;font-size: 1.2em;" href="<? echo Url::toRoute(['/site/delete', 'id' => $res_query[0]['id']]) ?>" onclick="return confirm('Вы уверены?')" >
                    Удалить
                </a>
                </div>
           </div> <?php
        }
      ?>

        </div>

    </div>
</div>
</div>
