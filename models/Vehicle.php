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
     public $vehicle_nos;
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

        [['vendor_id','vehicle_no','engine_no', 'chasis_no','vendor_id'],'required'],

         array(
            'engine_no',
            'match', 'not' => true, 'pattern' => '/[^0-9a-zA-Z_-]/',
            'message' => 'Invalid characters in Engine Number.',
        ),
           array(
            'chasis_no',
            'match', 'not' => true, 'pattern' => '/[^0-9a-zA-Z_-]/',
            'message' => 'Invalid characters in Chasis Number.',
        ),
            [['vendor_id', 'user_id'], 'integer'],
           
            [['corporation'], 'string'],
            ['vehicle_no','passwordCriteria'],
            ['vehicle_no', 'filter', 'filter'=>'strtoupper'],
            [['time'], 'safe'],
            [['vehicle_no'], 'string', 'max' => 10],
            [['engine_no', 'chasis_no'], 'string', 'max' => 25],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'user_id']],
            [['vendor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vendor::className(), 'targetAttribute' => ['vendor_id' => 'vendor_id']],
        ];
    }
public function passwordCriteria()
{
    if(!empty($this->vehicle_no)){
      
            if(!preg_match('/[A-Z]{2}[0-9|]{1,2}[A-Z|]{1,2}[0-9]{1,4}/',$this->vehicle_no)){
                $this->addError('vehicle_no','Invalid vehicle no format');
            }
          
        
    }
}
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'vehicle_id' => 'Vehicle ID',
            'vendor_id' => 'Vendor Code',
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
    public function getTransport()
    {
        return $this->hasOne(Transport::className(), ['transport_id' => 'vendor_id']);
    }
}
