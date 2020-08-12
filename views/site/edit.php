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
                <?php  $form = ActiveForm::begin(['id' => 'login-form']); ?>
                    <?= $form->field($model, 'title')->textInput(['value'=>$res_query[0]['title']]); ?>
                    <?= $form->field($model, 'description')->textarea(['value'=>$res_query[0]['description']]); ?>
                <?php   echo "<div class=\"container-fluid\" style=\"text-align: center;\">"; ?>
                <?= Html::submitButton('Сохранить',['class' =>'btn btn-primary','name'=>'login-button']); ?>
            </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
