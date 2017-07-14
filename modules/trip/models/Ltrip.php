<?php

namespace app\modules\trip\models;
use Yii;
use app\models\Driver;
use app\modules\payment\models\Lpayment;
use app\models\User;
use app\models\Vehicle;
use yii\db\Query;

/**
 * This is the model class for table "ltrip".
 *
 * @property int $trip_id
 * @property string $trip_no
 * @property int $vehicle_id
 * @property int $driver_id
 * @property string $load_date
 * @property string $origin
 * @property string $destination
 * @property int $total_km
 * @property int $corp_km
 * @property double $load_weight
 * @property double $trip_diesel
 * @property double $diesel_amount
 * @property string $unloaded_date
 * @property double $trip_advance
 * @property double $trip_expenses
 * @property double $frieght
 * @property double $totalexpense
 * @property double $trip_profit
 * @property int $payment_id
 * @property string $time
 * @property int $user_id
 * @property int $trip_status
 *
 * @property Dpayment[] $dpayments
 * @property Ldiesel[] $ldiesels
 * @property Lexpense[] $lexpenses
 * @property Lpayment[] $lpayments
 * @property Driver $driver
 * @property Lpayment $payment
 * @property User $user
 * @property Vehicle $vehicle
 */
class Ltrip extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ltrip';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vehicle_id', 'driver_id', 'total_km', 'corp_km', 'payment_id', 'user_id', 'trip_status'], 'integer'],
            [['load_date', 'unloaded_date', 'time'], 'safe'],
            [['load_weight', 'trip_diesel', 'diesel_amount', 'trip_advance', 'trip_expenses', 'frieght', 'totalexpense', 'trip_profit'], 'number'],
            [['trip_no'], 'string', 'max' => 20],
            [['origin', 'destination'], 'string', 'max' => 15],
            [['driver_id'], 'exist', 'skipOnError' => true, 'targetClass' => Driver::className(), 'targetAttribute' => ['driver_id' => 'driver_id']],
            [['payment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lpayment::className(), 'targetAttribute' => ['payment_id' => 'payment_id']],
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
            'trip_id' => 'Trip ID',
            'trip_no' => 'Trip No',
            'vehicle_id' => 'Vehicle ID',
            'driver_id' => 'Driver ID',
            'load_date' => 'Load Date',
            'origin' => 'Origin',
            'destination' => 'Destination',
            'total_km' => 'Total Km',
            'corp_km' => 'Corp Km',
            'load_weight' => 'Load Weight',
            'trip_diesel' => 'Trip Diesel',
            'diesel_amount' => 'Diesel Amount',
            'unloaded_date' => 'Unloaded Date',
            'trip_advance' => 'Trip Advance',
            'trip_expenses' => 'Trip Expenses',
            'frieght' => 'Frieght',
            'totalexpense' => 'Totalexpense',
            'trip_profit' => 'Trip Profit',
            'payment_id' => 'Payment ID',
            'time' => 'Time',
            'user_id' => 'User ID',
            'trip_status' => 'Trip Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDpayments()
    {
        return $this->hasMany(Dpayment::className(), ['trip_id' => 'trip_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLdiesels()
    {
        return $this->hasMany(Ldiesel::className(), ['trip_id' => 'trip_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLexpenses()
    {
        return $this->hasMany(Lexpense::className(), ['trip_id' => 'trip_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLpayments()
    {
        return $this->hasMany(Lpayment::className(), ['trip_id' => 'trip_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDriver()
    {
        return $this->hasOne(Driver::className(), ['driver_id' => 'driver_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayment()
    {
        return $this->hasOne(Lpayment::className(), ['payment_id' => 'payment_id']);
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
     * @inheritdoc
     * @return LtripQuery the active query used by this AR class.
     */
    public function getLtripDetails()
    {
        $query= new Query;
        $query ->from('ltrip AS t') //table name          
            ->select(['t.trip_id AS tripId','t.trip_no AS tripNo','v.vehicle_no AS vehicleNo', 'd.name AS driverName','t.load_date as loadDate','t.origin','t.destination','t.total_km as totalKm','t.corp_km as corpKm','t.load_weight as loadWeight','t.trip_diesel as tripDiesel','t.diesel_amount as dieselAmount','t.unloaded_date as unloadedDate','t.trip_advance AS tripDavance','t.trip_expenses as tripExpense','t.frieght','t.totalexpense','t.trip_profit as tripProfit'])
            ->innerJoin('vehicle AS v', 'v.vehicle_id = t.vehicle_id')
            ->innerJoin('driver AS d', 'd.driver_id = t.driver_id');                   
        $command = $query->createCommand();
        $models = $command->queryAll(); 
        return $models; 
    }
    public function getLtrip($id)
    {
        $query= new Query;
        $query ->from('ltrip AS t') //table name          
            ->select(['t.trip_id AS tripId','t.trip_no AS tripNo','v.vehicle_no AS vehicleNo', 'd.name AS driverName','t.driver_id AS driverId','t.load_date as loadDate','t.origin','t.destination','t.total_km as totalKm','t.corp_km as corpKm','t.load_weight as loadWeight','t.trip_diesel as tripDiesel','t.diesel_amount as dieselAmount','t.unloaded_date as unloadedDate','t.trip_advance AS tripAdvance','t.trip_expenses as tripExpense','t.frieght','t.totalexpense','t.trip_profit as tripProfit','c.card_no as cardNo','c.card_id as cardId','b.acc_no as accNo','b.dbank_id as bankId'])
            ->innerJoin('vehicle AS v', 'v.vehicle_id = t.vehicle_id')
            ->innerJoin('driver AS d', 'd.driver_id = t.driver_id')
            ->innerJoin('card AS c', 'c.vehicle_id = v.vehicle_id')
            ->leftJoin('dbank AS b', 'b.driver_id = d.driver_id')
            ->andWhere(['t.trip_id'=> $id]);                   
        $command = $query->createCommand();
        $models = $command->queryAll(); 
        return $models; 
    }
    public function getRun()
    {
        $query= new Query;
        $query ->from('ltrip AS t') //table name          
            ->select(['t.trip_id AS tripId','t.trip_no AS tripNo','v.vehicle_no as vehicleNo','t.trip_advance AS tripAdvance','t.totalexpense','t.diesel_amount as dieselAmount','t.trip_expenses as tripExpense'])
            ->innerJoin('driver AS d', 'd.driver_id = t.driver_id')
            ->innerJoin('vehicle AS v', 'v.vehicle_id = t.vehicle_id')
            ->andWhere(['v.ltrip'=> 1])
            ->andWhere(['t.trip_status'=> 2])
            ->orWhere(['t.trip_status'=> 1]);
                                 
        $command = $query->createCommand();
        $models = $command->queryAll(); 
        return $models; 
    }
    public function getCard($id)
    {
        $query= new Query;
        $query ->from('ltrip AS t') //table name          
            ->select(['t.trip_id AS tripId','t.trip_no AS tripNo','c.card_no as cardNo'])
            ->innerJoin('vehicle AS v', 'v.vehicle_id = t.vehicle_id')
            ->innerJoin('card AS c', 'c.vehicle_id = v.vehicle_id')
            ->andWhere(['v.ltrip'=> 1])
            ->andWhere(['c.is_active'=> 1])
            ->andWhere(['t.trip_id'=>$id ]);                    
        $command = $query->createCommand();
        $models = $command->queryAll(); 
        return $models; 
    }
}
