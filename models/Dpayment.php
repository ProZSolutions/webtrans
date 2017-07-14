<?php

namespace app\models;

use Yii;
use app\modules\trip\models\Ltrip;
/**
 * This is the model class for table "{{%dpayment}}".
 *
 * @property int $payment_id
 * @property int $driver_id
 * @property string $mode
 * @property int $amount
 * @property int $dbank_id
 * @property string $date
 * @property string $for
 * @property int $trip_id
 * @property int $user_id
 * @property string $time
 *
 * @property Driver $driver
 * @property Ltrip $trip
 * @property Dbank $dbank
 * @property User $user
 */
class Dpayment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%dpayment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['driver_id', 'amount', 'dbank_id', 'trip_id', 'user_id'], 'integer'],
            [['mode', 'for'], 'string'],
            [['date', 'time'], 'safe'],
            [['driver_id'], 'exist', 'skipOnError' => true, 'targetClass' => Driver::className(), 'targetAttribute' => ['driver_id' => 'driver_id']],
            [['trip_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ltrip::className(), 'targetAttribute' => ['trip_id' => 'trip_id']],
            [['dbank_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dbank::className(), 'targetAttribute' => ['dbank_id' => 'dbank_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'payment_id' => 'Payment ID',
            'driver_id' => 'Driver ID',
            'mode' => 'Mode',
            'amount' => 'Amount',
            'dbank_id' => 'Dbank ID',
            'date' => 'Date',
            'for' => 'For',
            'trip_id' => 'Trip ID',
            'user_id' => 'User ID',
            'time' => 'Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDriver()
    {
        return $this->hasOne(Driver::className(), ['driver_id' => 'driver_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrip()
    {
        return $this->hasOne(Ltrip::className(), ['trip_id' => 'trip_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDbank()
    {
        return $this->hasOne(Dbank::className(), ['dbank_id' => 'dbank_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }
}
