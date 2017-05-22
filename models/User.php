<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $user_id
 * @property string $name
 * @property string $password
 * @property string $designation
 * @property string $timestemap
 * @property integer $is_active
 *
 * @property BillList[] $billLists
 * @property Cdeposit[] $cdeposits
 * @property Dbank[] $dbanks
 * @property Driver[] $drivers
 * @property Expiry[] $expiries
 * @property Tbank[] $tbanks
 * @property Vehicle[] $vehicles
 * @property Vendor[] $vendors
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'password'], 'required'],
            [['designation'], 'string'],
            [['timestemap'], 'safe'],
            [['is_active'], 'integer'],
            [['name', 'password'], 'string', 'max' => 27],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'name' => 'Name',
            'password' => 'Password',
            'designation' => 'Designation',
            'timestemap' => 'Timestemap',
            'is_active' => 'Is Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBillLists()
    {
        return $this->hasMany(BillList::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCdeposits()
    {
        return $this->hasMany(Cdeposit::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDbanks()
    {
        return $this->hasMany(Dbank::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDrivers()
    {
        return $this->hasMany(Driver::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpiries()
    {
        return $this->hasMany(Expiry::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbanks()
    {
        return $this->hasMany(Tbank::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVehicles()
    {
        return $this->hasMany(Vehicle::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVendors()
    {
        return $this->hasMany(Vendor::className(), ['user_id' => 'user_id']);
    }
}
