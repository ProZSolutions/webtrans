<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lexpense".
 *
 * @property integer $trip_id
 * @property integer $expense_id
 * @property integer $load_wages
 * @property integer $phone
 * @property integer $spare
 * @property integer $cliner
 * @property integer $driver
 * @property integer $toll
 * @property integer $rto
 * @property integer $other
 * @property string $time
 *
 * @property Ltrip $trip
 */
class Lexpense extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lexpense';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trip_id', 'load_wages', 'phone', 'spare', 'cliner', 'driver', 'toll', 'rto', 'other'], 'integer'],
            [['time'], 'safe'],
            [['trip_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ltrip::className(), 'targetAttribute' => ['trip_id' => 'trip_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'trip_id' => 'Trip ID',
            'expense_id' => 'Expense ID',
            'load_wages' => 'Load Wages',
            'phone' => 'Phone',
            'spare' => 'Spare',
            'cliner' => 'Cliner',
            'driver' => 'Driver',
            'toll' => 'Toll',
            'rto' => 'Rto',
            'other' => 'Other',
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
}
