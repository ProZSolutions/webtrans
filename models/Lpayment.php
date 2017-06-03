<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lpayment".
 *
 * @property integer $payment_id
 * @property integer $trip_id
 * @property string $reference_no
 * @property string $payment_date
 * @property double $total_frieght
 * @property integer $vehicle_id
 * @property integer $tbank_id
 * @property integer $card_id
 * @property double $card_amount
 * @property integer $user_id
 * @property string $time
 *
 * @property Ltrip $trip
 * @property Vehicle $vehicle
 * @property Tbank $tbank
 * @property Card $card
 * @property User $user
 * @property Ltrip[] $ltrips
 */
class Lpayment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lpayment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trip_id', 'vehicle_id', 'tbank_id', 'card_id', 'user_id'], 'integer'],
            [['payment_date', 'time'], 'safe'],
            [['total_frieght', 'card_amount'], 'number'],
            [['reference_no'], 'string', 'max' => 20],
            [['trip_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ltrip::className(), 'targetAttribute' => ['trip_id' => 'trip_id']],
            [['vehicle_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vehicle::className(), 'targetAttribute' => ['vehicle_id' => 'vehicle_id']],
            [['tbank_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tbank::className(), 'targetAttribute' => ['tbank_id' => 'tbank_id']],
            [['card_id'], 'exist', 'skipOnError' => true, 'targetClass' => Card::className(), 'targetAttribute' => ['card_id' => 'card_id']],
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
            'trip_id' => 'Trip ID',
            'reference_no' => 'Reference No',
            'payment_date' => 'Payment Date',
            'total_frieght' => 'Total Frieght',
            'vehicle_id' => 'Vehicle ID',
            'tbank_id' => 'Tbank ID',
            'card_id' => 'Card ID',
            'card_amount' => 'Card Amount',
            'user_id' => 'User ID',
            'time' => 'Time',
        ];
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
    public function getVehicle()
    {
        return $this->hasOne(Vehicle::className(), ['vehicle_id' => 'vehicle_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbank()
    {
        return $this->hasOne(Tbank::className(), ['tbank_id' => 'tbank_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCard()
    {
        return $this->hasOne(Card::className(), ['card_id' => 'card_id']);
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
    public function getLtrips()
    {
        return $this->hasMany(Ltrip::className(), ['payment_id' => 'payment_id']);
    }
}
