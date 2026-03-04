<?php

use app\models\PayType;
use app\models\Status;
use app\models\ZalType;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Application $model */

$this->title = "Заявка на бронь №". $model->id . " от " . Yii::$app->formatter->asDatetime($model->created_at, 'php:d.m.Y H:i:s');
$this->params['breadcrumbs'][] = ['label' => 'Applications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="application-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Назад', ['/account/index'], ['class' => 'btn btn-outline-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
            'attribute'=>'created_at',
            'value'=>Yii::$app->formatter->asDatetime($model->created_at, 'php:d.m.Y H:i:s')
            ],
            [
            'attribute'=>'zal_type_id',
            'value'=>ZalType::getZalType()[$model->zal_type_id],
            ],
            [
            'attribute'=>'pay_type_id',
            'value'=>PayType::getPayType()[$model->pay_type_id],
            ],
            [
            'attribute'=>'status_id',
            'value'=>Status::getStatusTitle($model->status_id),
            ],
            [
            'attribute'=>'date_start',
            'value'=>Yii::$app->formatter->asDate($model->date_start, 'php:d.m.Y'),
            ],
            [
            'attribute'=>'time_start',
            'value'=>Yii::$app->formatter->asDate($model->time_start, 'php:H:i'),
            ]
            
        ],
    ]) ?>

</div>
