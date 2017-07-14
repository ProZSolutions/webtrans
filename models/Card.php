<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "card".
 *
 * @property int $card_id
 * @property string $card_no
 * @property string $corp
 * @property int $vehicle_id
 * @property string $cust_id
 * @property int $is_active
 *
 * @property Vehicle $vehicle
 * @property Cdeposit[] $cdeposits
 * @property Ldiesel[] $ldiesels
 * @property Lpayment[] $lpayments
 */
class Card extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'card';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['corp'], 'string'],
            [['vehicle_id', 'is_active'], 'integer'],
            [['card_no', 'cust_id'], 'string', 'max' => 20],
            [['vehicle_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vehicle::className(), 'targetAttribute' => ['vehicle_id' => 'vehicle_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'card_id' => 'Card ID',
            'card_no' => 'Card No',
            'corp' => 'Corp',
            'vehicle_id' => 'Vehicle No',//change id to No because error validation on client side
            'cust_id' => 'Cust ID',
            'is_active' => 'Is Active',
        ];
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
    public function getCdeposits()
    {
        return $this->hasMany(Cdeposit::className(), ['card_id' => 'card_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLdiesels()
    {
        return $this->hasMany(Ldiesel::className(), ['card_id' => 'card_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLpayments()
    {
        return $this->hasMany(Lpayment::className(), ['card_id' => 'card_id']);
    }
}
