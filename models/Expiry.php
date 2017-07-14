<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "expiry".
 *
 * @property int $vehicle_id
 * @property int $user_id
 * @property int $fc_id
 * @property string $fc_date
 * @property int $insurance_id
 * @property int $national_id
 * @property int $permit_id
 * @property int $explosive_id
 * @property int $yearly_id
 * @property int $halfyearly_id
 * @property int $hydro_id
 * @property int $cll_id
 * @property int $pli_id
 * @property int $tax_id
 * @property string $insurance_date
 * @property string $national_date
 * @property string $permit_date
 * @property string $explosive_date
 * @property string $yearly_date
 * @property string $halfyearly_date
 * @property string $hydro_date
 * @property string $cll_date
 * @property string $pli_date
 * @property string $tax_date
 *
 * @property User $user
 * @property Vehicle $vehicle
 */
class Expiry extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'expiry';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vehicle_id', 'user_id', 'fc_id', 'insurance_id', 'national_id', 'permit_id', 'explosive_id', 'yearly_id', 'halfyearly_id', 'hydro_id', 'cll_id', 'pli_id', 'tax_id'], 'integer'],
            [['fc_date', 'insurance_date', 'national_date', 'permit_date', 'explosive_date', 'yearly_date', 'halfyearly_date', 'hydro_date', 'cll_date', 'pli_date', 'tax_date'], 'safe'],
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
            'vehicle_id' => 'Vehicle ID',
            'user_id' => 'User ID',
            'fc_id' => 'Fc ID',
            'fc_date' => 'Fc Date',
            'insurance_id' => 'Insurance ID',
            'national_id' => 'National ID',
            'permit_id' => 'Permit ID',
            'explosive_id' => 'Explosive ID',
            'yearly_id' => 'Yearly ID',
            'halfyearly_id' => 'Halfyearly ID',
            'hydro_id' => 'Hydro ID',
            'cll_id' => 'Cll ID',
            'pli_id' => 'Pli ID',
            'tax_id' => 'Tax ID',
            'insurance_date' => 'Insurance Date',
            'national_date' => 'National Date',
            'permit_date' => 'Permit Date',
            'explosive_date' => 'Explosive Date',
            'yearly_date' => 'Yearly Date',
            'halfyearly_date' => 'Halfyearly Date',
            'hydro_date' => 'Hydro Date',
            'cll_date' => 'Cll Date',
            'pli_date' => 'Pli Date',
            'tax_date' => 'Tax Date',
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
    public static function primaryKey()
{
    return ['vehicle_id'];
}
}
