<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "{{%dbank}}".
 *
 * @property int $dbank_id
 * @property int $driver_id
 * @property string $bank_name
 * @property int $acc_no
 * @property string $branch
 * @property string $ifsc
 * @property int $is_active
 * @property int $user_id
 * @property string $time
 *
 * @property Driver $driver
 * @property User $user
 * @property Dpayment[] $dpayments
 */
class Dbank extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%dbank}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['driver_id', 'acc_no', 'is_active', 'user_id'], 'integer'],
            [['time'], 'safe'],
            [['bank_name'], 'string', 'max' => 18],
            [['branch'], 'string', 'max' => 20],
            [['ifsc'], 'string', 'max' => 12],
            [['driver_id'], 'exist', 'skipOnError' => true, 'targetClass' => Driver::className(), 'targetAttribute' => ['driver_id' => 'driver_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dbank_id' => 'Dbank ID',
            'driver_id' => 'Driver ID',
            'bank_name' => 'Bank Name',
            'acc_no' => 'Acc No',
            'branch' => 'Branch',
            'ifsc' => 'Ifsc',
            'is_active' => 'Is Active',
            'user_id' => 'User ID',
            'time' => 'Time',
        ];
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDpayments()
    {
        return $this->hasMany(Dpayment::className(), ['dbank_id' => 'dbank_id']);
    }

    public function viewBankDetails($id)
    {
        $query= new Query;
        $query ->from('dbank as db') //table name     
            ->select(['db.dbank_id as bankId','db.bank_name AS bankName','db.acc_no AS accountNo', 'db.branch','db.ifsc'])
            ->innerJoin('driver', 'driver.driver_id = db.driver_id')  
            ->andWhere(['db.is_active'=> 1,'db.dbank_id'=>$id]);         
        $command = $query->createCommand();
        $models = $command->queryAll();
        return $models;
    }

    public function getBankDetails()
    {
        $query= new Query;//refer from use yii\db\Query.It is initialize start the prg
        $query ->from('dbank as db') //table name     
            ->select(['db.dbank_id as bankId','db.bank_name AS bankName','db.acc_no AS accountNo', 'db.branch','db.ifsc'])
            ->innerJoin('driver', 'driver.driver_id = db.driver_id')  
            ->andWhere(['db.is_active'=> 1]);         
        $command = $query->createCommand();
        $models = $command->queryAll();
        return $models;
    }
      public function viewDriverBank($id)
    {
        $query= new Query;//refer from use yii\db\Query.It is initialize start the prg
        $query ->from('dbank as db') //table name     
            ->select(['db.dbank_id as bankId','db.bank_name AS bankName','db.acc_no AS accountNo', 'db.branch','db.ifsc'])
            ->innerJoin('driver', 'driver.driver_id = db.driver_id')  
            ->andWhere(['db.is_active'=> 1,'db.driver_id'=>$id]);         
        $command = $query->createCommand();
        $models = $command->queryAll();
        return $models;
    }
    
}
