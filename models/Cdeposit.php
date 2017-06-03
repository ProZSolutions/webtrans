<?php

namespace app\models;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "cdeposit".
 *
 * @property integer $cdeposit_id
 * @property integer $card_id
 * @property double $amount
 * @property string $date
 * @property string $time
 * @property integer $vehicle_id
 * @property integer $tbank_id
 * @property string $deposit_by
 * @property integer $user_id
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
    public function behaviors()
    {
        return [
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['date'], // update 1 attribute 'created' OR multiple attribute ['created','updated']
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['date']// update 1 attribute 'created' OR multiple attribute ['created','updated']
                ],
                'value' => function ($event) {
                    return date('Y-m-d',strtotime($this->date));
                },
            ],
        ];
    }
    public function rules()
    {
        return [
        [['card_id', 'vehicle_id', 'tbank_id','amount','deposit_by'],'required'],
            array(
            'deposit_by',
            'match', 'not' => true, 'pattern' => '/[^a-zA-Z\s]/',
            'message' => 'Invalid characters in Depositer Name.',
        ),
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
            'card_id' => 'Card Number',
            'amount' => 'Amount',
            'date' => 'Date',
            'time' => 'Time',
            'vehicle_id' => 'Vehicle Number',
            'tbank_id' => 'Account Number',
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
