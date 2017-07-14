<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cdeposit".
 *
 * @property int $cdeposit_id
 * @property int $card_id
 * @property double $amount
 * @property string $date
 * @property string $time
 * @property int $vehicle_id
 * @property int $tbank_id
 * @property string $deposit_by
 * @property int $user_id
 *
 * @property Card $card
 * @property Vehicle $vehicle
 * @property Tbank $tbank
 * @property User $user
 */
class Cdeposit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cdeposit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['card_id', 'vehicle_id', 'tbank_id', 'user_id'], 'integer'],
            [['amount'], 'number'],
            [['date', 'time'], 'safe'],
            [['deposit_by'], 'required'],
            [['deposit_by'], 'string', 'max' => 20],
            [['card_id'], 'exist', 'skipOnError' => true, 'targetClass' => Card::className(), 'targetAttribute' => ['card_id' => 'card_id']],
            [['vehicle_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vehicle::className(), 'targetAttribute' => ['vehicle_id' => 'vehicle_id']],
            [['tbank_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tbank::className(), 'targetAttribute' => ['tbank_id' => 'tbank_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cdeposit_id' => 'Cdeposit ID',
            'card_id' => 'Card No',
            'amount' => 'Amount',
            'date' => 'Date',
            'time' => 'Time',
            'vehicle_id' => 'Vehicle No',
            'tbank_id' => 'Account No',
            'deposit_by' => 'Deposit By',
            'user_id' => 'User ID',
        ];
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }
}
