<?php

namespace app\models;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "ltrip".
 *
 * @property integer $vehicle_id
 * @property integer $trip_id
 * @property integer $driver_id
 * @property string $load_date
 * @property string $origin
 * @property string $destination
 * @property integer $total_km
 * @property integer $corp_km
 * @property double $load_weight
 * @property double $trip_diesel
 * @property double $diesel_amount
 * @property string $unloaded_date
 * @property double $trip_advance
 * @property double $trip_expenses
 * @property double $frieght
 * @property double $trip_profit
 * @property integer $payment_id
 * @property string $time
 * @property integer $user_id
 *
 * @property Dpayment[] $dpayments
 * @property Ldiesel[] $ldiesels
 * @property Lexpense[] $lexpenses
 * @property Lpayment[] $lpayments
 * @property Driver $driver
 * @property Lpayment $payment
 * @property User $user
 * @property Vehicle $vehicle
 */
class Ltrip extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ltrip';
    }

       public function behaviors()
    {
        return [
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['unloaded_date'], // update 1 attribute 'created' OR multiple attribute ['created','updated']
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['unloaded_date']// update 1 attribute 'created' OR multiple attribute ['created','updated']
                ],
                'value' => function ($event) {
                    return date('Y-m-d',strtotime($this->unloaded_date));
                },
            ],
             [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['load_date'], // update 1 attribute 'created' OR multiple attribute ['created','updated']
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['load_date']// update 1 attribute 'created' OR multiple attribute ['created','updated']
                ],
                'value' => function ($event) {
                    return date('Y-m-d',strtotime($this->load_date));
                },
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vehicle_id', 'driver_id', 'total_km', 'corp_km', 'payment_id', 'user_id'], 'integer'],
            [['load_date', 'unloaded_date', 'time'], 'safe'],
            // [['load_weight', 'trip_diesel', 'diesel_amount', 'trip_advance', 'trip_expenses', 'frieght'], 'required'],
            [['load_weight', 'trip_diesel', 'diesel_amount', 'trip_advance', 'trip_expenses', 'frieght', 'trip_profit'], 'number'],
            [['origin', 'destination'], 'string', 'max' => 15],
            [['driver_id'], 'exist', 'skipOnError' => true, 'targetClass' => Driver::className(), 'targetAttribute' => ['driver_id' => 'driver_id']],
            [['payment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lpayment::className(), 'targetAttribute' => ['payment_id' => 'payment_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'user_id']],
            [['vehicle_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vehicle::className(), 'targetAttribute' => ['vehicle_id' => 'vehicle_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'vehicle_id' => 'Vehicle ID',
            'trip_id' => 'Trip ID',
            'driver_id' => 'Driver ID',
            'load_date' => 'Load Date',
            'origin' => 'Origin',
            'destination' => 'Destination',
            'total_km' => 'Total Km',
            'corp_km' => 'Corp Km',
            'load_weight' => 'Load Weight',
            'trip_diesel' => 'Trip Diesel',
            'diesel_amount' => 'Diesel Amount',
            'unloaded_date' => 'Unloaded Date',
            'trip_advance' => 'Trip Advance',
            'trip_expenses' => 'Trip Expenses',
            'frieght' => 'Frieght',
            'trip_profit' => 'Trip Profit',
            'payment_id' => 'Payment ID',
            'time' => 'Time',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDpayments()
    {
        return $this->hasMany(Dpayment::className(), ['trip_id' => 'trip_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLdiesels()
    {
        return $this->hasMany(Ldiesel::className(), ['trip_id' => 'trip_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLexpenses()
    {
        return $this->hasMany(Lexpense::className(), ['trip_id' => 'trip_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLpayments()
    {
        return $this->hasMany(Lpayment::className(), ['trip_id' => 'trip_id']);
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
    public function getPayment()
    {
        return $this->hasOne(Lpayment::className(), ['payment_id' => 'payment_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVehicle()
    {
        return $this->hasOne(Vehicle::className(), ['vehicle_id' => 'vehicle_id']);
    }
}
