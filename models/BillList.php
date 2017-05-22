<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bill_list".
 *
 * @property integer $vehicle_id
 * @property integer $bill_id
 * @property string $type
 * @property string $from
 * @property string $to
 * @property double $amount
 * @property string $paid_date
 * @property string $num
 * @property integer $user_id
 * @property string $time
 *
 * @property User $user
 * @property Vehicle $vehicle
 */
class BillList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bill_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vehicle_id', 'user_id'], 'integer'],
            [['from', 'to', 'paid_date', 'time'], 'safe'],
            [['amount'], 'number'],
            [['type'], 'string', 'max' => 10],
            [['num'], 'string', 'max' => 25],
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
            'bill_id' => 'Bill ID',
            'type' => 'Type',
            'from' => 'From',
            'to' => 'To',
            'amount' => 'Amount',
            'paid_date' => 'Paid Date',
            'num' => 'Num',
            'user_id' => 'User ID',
            'time' => 'Time',
        ];
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
