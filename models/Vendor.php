<?php
namespace app\models;
use Yii;
/**
 * This is the model class for table "vendor".
 *
 * @property int $vendor_id
 * @property int $transport_id
 * @property string $vendor_code
 * @property string $vendor_corp
 * @property int $user_id
 * @property string $time
 * @property int $is_active
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
            [['transport_id', 'vendor_corp', 'vendor_code'], 'required'],         
            [['time'], 'safe'],
            [['vendor_code'], 'string', 'max' => 15],
            [['vendor_corp'], 'string', 'max' => 6],
            [['vendor_code'], 'unique','message'=>'Vendor code already exist'],
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
