<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */
use yii\widgets\LinkPager;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<div class="site">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">

                <?php  $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?= $form->field($model, 'title')->textInput()?>
                <?= $form->field($model, 'description')->textarea()?>
                <div style="text-align: center;">
                <?= Html::submitButton('Добавить',['class' =>'btn btn-primary','name'=>'button']); ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>

</div>
