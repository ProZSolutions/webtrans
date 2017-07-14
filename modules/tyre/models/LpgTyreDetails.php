<?php

namespace app\modules\trip\models;

use Yii;

/**
 * This is the model class for table "{{%lpg_tyre_details}}".
 *
 * @property int $tyre_id
 * @property int $vehicle_id
 * @property string $bill_no
 * @property string $company
 * @property double $price
 * @property int $starting_KM
 * @property string $type
 * @property int $total_KM
 * @property string $purchase_date
 * @property string $status
 * @property string $tyre_no
 * @property int $user_id
 * @property string $time
 *
 * @property User $user
 * @property Vehicle $vehicle
 */
class LpgTyreDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%lpg_tyre_details}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vehicle_id', 'starting_KM', 'total_KM', 'user_id'], 'integer'],
            [['price'], 'number'],
            [['type', 'status'], 'required'],
            [['type', 'status'], 'string'],
            [['purchase_date', 'time'], 'safe'],
            [['bill_no', 'company'], 'string', 'max' => 15],
            [['tyre_no'], 'string', 'max' => 25],
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
            'tyre_id' => 'Tyre ID',
            'vehicle_id' => 'Vehicle ID',
            'bill_no' => 'Bill No',
            'company' => 'Company',
            'price' => 'Price',
            'starting_KM' => 'Starting  Km',
            'type' => 'Type',
            'total_KM' => 'Total  Km',
            'purchase_date' => 'Purchase Date',
            'status' => 'Status',
            'tyre_no' => 'Tyre No',
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
