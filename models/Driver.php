<?php

namespace app\models;
use Yii;

/**
 * This is the model class for table "driver".
 *
 * @property integer $driver_id
 * @property string $name
 * @property string $license_no
 * @property string $expiry
 * @property string $address
 * @property string $contact
 * @property string $refrence
 * @property string $license_type
 * @property string $join_date
 * @property integer $is_active
 * @property integer $user_id
 * @property string $time
 * @property integer $vehicle_id
 *
 * @property Dbank[] $dbanks
 * @property User $user
 * @property Vehicle $vehicle
 */
class Driver extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'driver';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {


        return [
         [['name','license_no','expiry','address','contact','refrence','license_type','join_date','user_id','time','vehicle_id'],'required'],
         array(
            'name',
            'match', 'not' => true, 'pattern' => '/[^a-zA-Z\s]/',
            'message' => 'Invalid characters in Driver name.',
        ),
         array(
            'license_no',
            'match', 'not' => true, 'pattern' => '/[^0-9a-zA-Z_-]/',
            'message' => 'Invalid characters in license no.',
        ),
        //  array(
        //     'contact',
        //     'match', 'not' => true, 'pattern' => '^\d{4}-\d{3}-\d{4}$',
        //     'message' => 'Invalid characters in Contact no.',
        // ),
        array(
            'refrence',
            'match', 'not' => true, 'pattern' => '/[^a-zA-Z\s]/',
            'message' => 'Invalid characters in refrence.',
        ),

            [['expiry', 'join_date', 'time'], 'safe'],
            [['is_active', 'user_id', 'vehicle_id'], 'integer'],
            [['name'], 'string', 'max' => 17],
            [['license_no'], 'string', 'max' => 20],
            [['address'], 'string', 'max' => 70],
            [['contact'], 'integer',],
            [['refrence'], 'string', 'max' => 20],
            [['license_type'], 'string', 'max' => 10],
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
            'driver_id' => 'Driver ID',
            'name' => 'Driver Name',
            'license_no' => 'License No',
            'expiry' => 'Expiry Date',
            'address' => 'Address',
            'contact' => 'Contact No',
            'refrence' => 'Refrence',
            'license_type' => 'License Type',
            'join_date' => 'Join Date',
            'is_active' => 'Is Active',
            'user_id' => 'User ID',
            'time' => 'Time',
            'vehicle_id' => 'Vehicle ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDbanks()
    {
        return $this->hasMany(Dbank::className(), ['driver_id' => 'driver_id']);
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
