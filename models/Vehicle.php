<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vehicle".
 *
 * @property integer $vehicle_id
 * @property integer $vendor_id
 * @property string $vehicle_no
 * @property string $engine_no
 * @property string $chasis_no
 * @property string $corporation
 * @property integer $type
 * @property integer $user_id
 * @property string $time
 *
 * @property BillList[] $billLists
 * @property Cdeposit[] $cdeposits
 * @property Driver[] $drivers
 * @property Expiry[] $expiries
 * @property User $user
 * @property Vendor $vendor
 */
class Vehicle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vehicle';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vendor_id', 'type', 'user_id'], 'integer'],
            [['vehicle_no', 'type'], 'required'],
            [['corporation'], 'string'],
            [['time'], 'safe'],
            [['vehicle_no'], 'string', 'max' => 10],
            [['engine_no', 'chasis_no'], 'string', 'max' => 25],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'user_id']],
            [['vendor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vendor::className(), 'targetAttribute' => ['vendor_id' => 'vendor_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'vehicle_id' => 'Vehicle ID',
            'vendor_id' => 'Vendor ID',
            'vehicle_no' => 'Vehicle No',
            'engine_no' => 'Engine No',
            'chasis_no' => 'Chasis No',
            'corporation' => 'Corporation',
            'type' => 'Type',
            'user_id' => 'User ID',
            'time' => 'Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBillLists()
    {
        return $this->hasMany(BillList::className(), ['vehicle_id' => 'vehicle_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCdeposits()
    {
        return $this->hasMany(Cdeposit::className(), ['vehicle_id' => 'vehicle_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDrivers()
    {
        return $this->hasMany(Driver::className(), ['vehicle_id' => 'vehicle_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpiries()
    {
        return $this->hasMany(Expiry::className(), ['vehicle_id' => 'vehicle_id']);
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
    public function getVendor()
    {
        return $this->hasOne(Vendor::className(), ['vendor_id' => 'vendor_id']);
    }
}