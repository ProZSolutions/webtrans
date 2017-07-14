<?php

namespace app\models;

use Yii;
use yii\db\Query;


/**
 * This is the model class for table "{{%driver}}".
 *
 * @property int $driver_id
 * @property string $name
 * @property string $license_no
 * @property string $expiry
 * @property string $address
 * @property string $contact
 * @property string $refrence
 * @property string $license_type
 * @property string $join_date
 * @property int $is_active
 * @property int $user_id
 * @property string $time
 * @property int $vehicle_id
 *
 * @property Dbank[] $dbanks
 * @property Dpayment[] $dpayments
 * @property User $user
 * @property Vehicle $vehicle
 * @property Ltrip[] $ltrips
 */
class Driver extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%driver}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['expiry', 'join_date', 'time'], 'safe'],
            [['is_active', 'user_id', 'vehicle_id'], 'integer'],
            [['name'], 'string', 'max' => 17],
            [['license_no'], 'string', 'max' => 18],
            [['address'], 'string', 'max' => 70],
            [['contact', 'refrence'], 'string', 'max' => 40],
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
            'name' => 'Name',
            'license_no' => 'License No',
            'expiry' => 'Expiry',
            'address' => 'Address',
            'contact' => 'Contact',
            'refrence' => 'Refrence',
            'license_type' => 'License Type',
            'join_date' => 'Join Date',
            'is_active' => 'Is Active',
            'user_id' => 'User ID',
            'time' => 'Time',
            'vehicle_id' => 'Vehicle No',
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
    public function getDpayments()
    {
        return $this->hasMany(Dpayment::className(), ['driver_id' => 'driver_id']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLtrips()
    {
        return $this->hasMany(Ltrip::className(), ['driver_id' => 'driver_id']);
    }
      public function viewDriverDetails($id)
    {
        $query= new Query;
        $query ->from('driver as d') //table name     
            ->select(["DATE_FORMAT(d.expiry, '%d-%m-%Y') as expiry",'d.driver_id as driverId','d.name','d.license_no AS licenseNo','d.address','d.contact','d.refrence','d.license_type as licenseType','vehicle.vehicle_id as vehicleId','vehicle.vehicle_no as vehicleNo',"DATE_FORMAT(d.join_date, '%d-%m-%Y') as joinDate"])
            ->innerJoin('vehicle', 'vehicle.vehicle_id = d.vehicle_id')  
            ->andWhere(['d.is_active'=> 1,'d.driver_id'=>$id]);         
        $command = $query->createCommand();
        $models = $command->queryAll(); 
                return $models;
    }
       public function defaultDriver($id)
    {
        $query= new Query;
        $query ->from('driver as d') //table name     
            ->select(['d.driver_id as driverId','d.name'])
            ->innerJoin('vehicle', 'vehicle.vehicle_id = d.vehicle_id')  
            ->andWhere(['d.is_active'=> 1,'vehicle.vehicle_id'=>$id]);         
        $command = $query->createCommand();
        $models = $command->queryAll(); 
                return $models;
    }

      public function getDriverDetails()
    {
        $query= new Query;
        $query ->from('driver as d')    
            ->select(["DATE_FORMAT(d.expiry, '%d-%m-%Y') as expiry",'d.driver_id as driverId','d.name','d.license_no AS licenseNo','d.address','d.contact','d.refrence','d.license_type as licenseType','vehicle.vehicle_id as vehicleId','vehicle.vehicle_no as vehicleNo',"DATE_FORMAT(d.join_date, '%d-%m-%Y') as joinDate"])
            ->innerJoin('vehicle', 'vehicle.vehicle_id = d.vehicle_id')  
            ->andWhere(['d.is_active'=> 1]);         
        $command = $query->createCommand();
        $models = $command->queryAll(); 
        return $models;
    }
}
