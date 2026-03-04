<?php
use app\models\ZalType;
use app\models\PayType;
use app\models\Status;
use yii\helpers\Html;
use yii\widgets\DetailView;
?>

<div class="card my-2">
  <div class="card-header">
   <?= "Заявка на бронь №". $model->id . " от " . Yii::$app->formatter->asDatetime($model->created_at, 'php:d.m.Y H:i:s') ?>
  </div>
  <div class="card-body">
    <h5 class="card-title"> 
        <?= ZalType::getZalType()[$model->zal_type_id] ?>
     </h5>
    <p class="card-text"> Статус заявки:
        <?= Status::getStatusTitle($model->status_id) ?>
    </p>
    <p class="card-text"> Дата и время начала:
        <?= Yii::$app->formatter->asDate($model->date_start, 'php:d.m.Y  '),
       Yii::$app->formatter->asDate($model->time_start, 'php:H:i')
     ?>
     </p>

      <p class="card-text"> Тип оплаты:
        <?= PayType::getPayType()[$model->pay_type_id] ?>
    </p>

    <div class="d-flex justify-content-end gap-3">
       <?= Html::a('Просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-outline-info']) ?>
       
    </div>
  </div>
</div>