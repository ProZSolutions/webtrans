<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "bill_list".
 *
 * @property int $vehicle_id
 * @property int $bill_id
 * @property string $type
 * @property string $from
 * @property string $to
 * @property double $amount
 * @property string $paid_date
 * @property string $num
 * @property int $user_id
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
            'vehicle_id' => 'Vehicle No',
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
    public function getBillList()
    {
        $query= new Query;//refer from use yii\db\Query.It is initialize start the prg
        $query ->from('bill_list') //table name          
        ->select(['bill_list.bill_id as billId','vehicle.vehicle_no as vehicleNo','bill_list.type',"DATE_FORMAT(bill_list.from, '%d-%m-%Y') as fromDate", "DATE_FORMAT(bill_list.to, '%d-%m-%Y') as toDate",'bill_list.amount',"DATE_FORMAT(bill_list.paid_date, '%d-%m-%Y') as paidDate",'bill_list.num as billNo','vehicle.vehicle_id as vehicleId'])
        ->innerJoin('vehicle', 'vehicle.vehicle_id = bill_list.vehicle_id');                     
        $command = $query->createCommand();
        $models = $command->queryAll();  
        return $models;
    }
     public function viewBill($id)
    {
        $query= new Query;//refer from use yii\db\Query.It is initialize start the prg
        $query ->from('bill_list') //table name          
        ->select(['bill_list.bill_id as billId','vehicle.vehicle_no as vehicleNo','bill_list.type',"DATE_FORMAT(bill_list.from, '%d-%m-%Y') as fromDate", "DATE_FORMAT(bill_list.to, '%d-%m-%Y') as toDate",'bill_list.amount',"DATE_FORMAT(bill_list.paid_date, '%d-%m-%Y') as paidDate",'bill_list.num as billNo','vehicle.vehicle_id as vehicleId'])
        ->innerJoin('vehicle', 'vehicle.vehicle_id = bill_list.vehicle_id')
        ->andWhere(['bill_list.bill_id'=>$id]);                    
        $command = $query->createCommand();
        $models = $command->queryAll();  
        return $models;
    }
}
  