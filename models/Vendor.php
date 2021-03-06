<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vendor".
 *
 * @property integer $vendor_id
 * @property integer $transport_id
 * @property string $vendor_code
 * @property string $verdor_corp
 * @property integer $user_id
 * @property string $time
 * @property integer $is_active
 *
 * @property Vehicle[] $vehicles
 * @property Transport $transport
 * @property User $user
 */
class Vendor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vendor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

        [['transport_id','vendor_code', 'vendor_corp'],'required'],

     
        array(
            'vendor_code',
            'match', 'not' => true, 'pattern' => '/[^0-9a-zA-Z_-]/',
            'message' => 'Invalid characters in vendor code.',
        ),

           
            [['transport_id', 'user_id', 'is_active'], 'integer'],
            [['time'], 'safe'],
            [['vendor_code'], 'string', 'max' => 15],
            [['vendor_corp'], 'string', 'max' => 6],
            [['transport_id'], 'exist', 'skipOnError' => true, 'targetClass' => Transport::className(), 'targetAttribute' => ['transport_id' => 'transport_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }
    

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'vendor_id' => 'Vendor ID',
            'transport_id' => 'Transport Name',
            'vendor_code' => 'Vendor Code',
            'vendor_corp' => 'Vendor Corp',
            'user_id' => 'User ID',
            'time' => 'Time',
            'is_active' => 'Is Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVehicles()
    {
        return $this->hasMany(Vehicle::className(), ['vendor_id' => 'vendor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransport()
    {
        return $this->hasOne(Transport::className(), ['transport_id' => 'transport_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }
}
 