<?php

namespace app\modules\trip\models;

use Yii;

/**
 * This is the model class for table "{{%lpg_tyre}}".
 *
 * @property int $Vehicle_id
 * @property string $Fl_id
 * @property string $Fl_date
 * @property string $Fr_id
 * @property string $Fr_date
 * @property string $Col_id
 * @property string $Col_date
 * @property string $Cil_id
 * @property string $Cil_date
 * @property string $Cor_id
 * @property string $Cor_date
 * @property string $Cir_id
 * @property string $Cir_date
 * @property string $Afol_id
 * @property string $Afil_id
 * @property string $Afor_id
 * @property string $Afir_id
 * @property string $Afol_date
 * @property string $Afil_date
 * @property string $Afor_date
 * @property string $Afir_date
 * @property string $Acol_id
 * @property string $Acil_id
 * @property string $Acor_id
 * @property string $Acir_id
 * @property string $Acol_date
 * @property string $Acil_date
 * @property string $Acor_date
 * @property string $Acir_date
 * @property string $Abol_id
 * @property string $Abil_id
 * @property string $Abor_id
 * @property string $Abir_id
 * @property string $Abol_date
 * @property string $Abil_date
 * @property string $Abor_date
 * @property string $Abir_date
 * @property string $Adt_id
 * @property string $Adt_date
 *
 * @property Vehicle $vehicle
 */
class LpgTyre extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%lpg_tyre}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Vehicle_id'], 'required'],
            [['Vehicle_id'], 'integer'],
            [['Fl_date', 'Fr_date', 'Col_date', 'Cil_date', 'Cor_date', 'Cir_date', 'Afol_date', 'Afil_date', 'Afor_date', 'Afir_date', 'Acol_date', 'Acil_date', 'Acor_date', 'Acir_date', 'Abol_date', 'Abil_date', 'Abor_date', 'Abir_date', 'Adt_date'], 'safe'],
            [['Fl_id', 'Fr_id', 'Col_id', 'Cil_id', 'Cor_id', 'Cir_id', 'Afol_id', 'Afil_id', 'Afor_id', 'Afir_id', 'Acol_id', 'Acil_id', 'Acor_id', 'Acir_id', 'Abol_id', 'Abil_id', 'Abor_id', 'Abir_id', 'Adt_id'], 'string', 'max' => 5],
            [['Vehicle_id'], 'unique'],
            [['Vehicle_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vehicle::className(), 'targetAttribute' => ['Vehicle_id' => 'vehicle_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Vehicle_id' => 'Vehicle ID',
            'Fl_id' => 'Fl ID',
            'Fl_date' => 'Fl Date',
            'Fr_id' => 'Fr ID',
            'Fr_date' => 'Fr Date',
            'Col_id' => 'Col ID',
            'Col_date' => 'Col Date',
            'Cil_id' => 'Cil ID',
            'Cil_date' => 'Cil Date',
            'Cor_id' => 'Cor ID',
            'Cor_date' => 'Cor Date',
            'Cir_id' => 'Cir ID',
            'Cir_date' => 'Cir Date',
            'Afol_id' => 'Afol ID',
            'Afil_id' => 'Afil ID',
            'Afor_id' => 'Afor ID',
            'Afir_id' => 'Afir ID',
            'Afol_date' => 'Afol Date',
            'Afil_date' => 'Afil Date',
            'Afor_date' => 'Afor Date',
            'Afir_date' => 'Afir Date',
            'Acol_id' => 'Acol ID',
            'Acil_id' => 'Acil ID',
            'Acor_id' => 'Acor ID',
            'Acir_id' => 'Acir ID',
            'Acol_date' => 'Acol Date',
            'Acil_date' => 'Acil Date',
            'Acor_date' => 'Acor Date',
            'Acir_date' => 'Acir Date',
            'Abol_id' => 'Abol ID',
            'Abil_id' => 'Abil ID',
            'Abor_id' => 'Abor ID',
            'Abir_id' => 'Abir ID',
            'Abol_date' => 'Abol Date',
            'Abil_date' => 'Abil Date',
            'Abor_date' => 'Abor Date',
            'Abir_date' => 'Abir Date',
            'Adt_id' => 'Adt ID',
            'Adt_date' => 'Adt Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVehicle()
    {
        return $this->hasOne(Vehicle::className(), ['vehicle_id' => 'Vehicle_id']);
    }
}
