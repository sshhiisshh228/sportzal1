<?php

use app\models\PayType;
use app\models\ZalType;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Application $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="application-form">

    <?php $form = ActiveForm::begin(); ?>

    
    <?= $form->field($model, 'zal_type_id')->dropDownList([
    ZalType::getZalType(),
    ], ['prompt'=>'Выберите зал для брони']) ?>
    
   

    <?= $form->field($model, 'pay_type_id')->dropDownList([
    PayType::getPayType(),
    ], ['prompt'=>'Выберите тип оплаты']) ?>

     <div class="col-md3 col-12">
        <?= $form->field($model, 'date_start')->textInput(['type'=>'date', 'min'=> date('Y-m-d')]) ?>
    </div>

    <div class="col-md3 col-12">
        <?= $form->field($model, 'time_start')->textInput(['type'=>'time']) ?> 
    </div>

   

    <div class="form-group">
        <?= Html::submitButton('Оставить заявку на бронь', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>
