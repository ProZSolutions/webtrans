<?php

namespace app\modules\trip\models;

use Yii;

/**
 * This is the model class for table "{{%lexpense}}".
 *
 * @property int $trip_id
 * @property int $expense_id
 * @property int $load_wages
 * @property int $phone
 * @property int $spare
 * @property int $cliner
 * @property int $driver
 * @property int $toll
 * @property int $rto
 * @property int $other
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
        return '{{%lexpense}}';
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
