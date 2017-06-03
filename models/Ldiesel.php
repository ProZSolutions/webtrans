<?php

namespace app\models;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;


/**
 * This is the model class for table "ldiesel".
 *
 * @property integer $trip_id
 * @property integer $ldiesel_id
 * @property integer $card_id
 * @property string $fill_date
 * @property double $diesel_price
 * @property double $total_diesel
 * @property double $diesel_amount
 * @property string $payment_mode
 * @property string $time
 * @property string $place
 *
 * @property Ltrip $trip
 * @property Card $card
 */
class Ldiesel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ldiesel';
    }

public function behaviors()
    {
        return [
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['fill_date'], // update 1 attribute 'created' OR multiple attribute ['created','updated']
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['fill_date']// update 1 attribute 'created' OR multiple attribute ['created','updated']
                ],
                'value' => function ($event) {
                    return date('Y-m-d',strtotime($this->fill_date));
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
            [['trip_id', 'card_id'], 'integer'],
            [['fill_date', 'time'], 'safe'],
            [['diesel_price', 'total_diesel', 'diesel_amount'], 'number'],
            [['payment_mode'], 'string'],
            [['place'], 'string', 'max' => 15],
            [['trip_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ltrip::className(), 'targetAttribute' => ['trip_id' => 'trip_id']],
            [['card_id'], 'exist', 'skipOnError' => true, 'targetClass' => Card::className(), 'targetAttribute' => ['card_id' => 'card_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'trip_id' => 'Trip ID',
            'ldiesel_id' => 'Ldiesel ID',
            'card_id' => 'Card ID',
            'fill_date' => 'Fill Date',
            'diesel_price' => 'Diesel Price',
            'total_diesel' => 'Total Diesel',
            'diesel_amount' => 'Diesel Amount',
            'payment_mode' => 'Payment Mode',
            'time' => 'Time',
            'place' => 'Place',
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
    public function getCard()
    {
        return $this->hasOne(Card::className(), ['card_id' => 'card_id']);
    }
}
