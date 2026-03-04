<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "application".
 *
 * @property int $id
 * @property int $user_id
 * @property int $zal_type_id
 * @property int $pay_type_id
 * @property string $created_at
 * @property string $date_start
 * @property int $status_id
 * @property string $time_start
 *
 * @property PayType $payType
 * @property Status $status
 * @property User $user
 * @property ZalType $zalType
 */
class Application extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'application';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'zal_type_id', 'pay_type_id',  'date_start', 'time_start'], 'required'],
            [['user_id', 'zal_type_id', 'pay_type_id', 'status_id'], 'integer'],
            [['created_at', 'date_start', 'time_start'], 'safe'],
            [['zal_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ZalType::class, 'targetAttribute' => ['zal_type_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['status_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['pay_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => PayType::class, 'targetAttribute' => ['pay_type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Клиент',
            'zal_type_id' => 'Зал',
            'pay_type_id' => 'Тип оплаты',
            'created_at' => 'Дата и время создания',
            'date_start' => 'Дата начала',
            'status_id' => 'Статус',
            'time_start' => 'Время начала',
        ];
    }

    /**
     * Gets query for [[PayType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPayType()
    {
        return $this->hasOne(PayType::class, ['id' => 'pay_type_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * Gets query for [[ZalType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getZalType()
    {
        return $this->hasOne(ZalType::class, ['id' => 'zal_type_id']);
    }

}
