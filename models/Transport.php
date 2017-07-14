<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transport".
 *
 * @property int $transport_id
 * @property string $name
 * @property string $owner
 * @property string $time
 *
 * @property Tbank[] $tbanks
 * @property Vendor[] $vendors
 */
class Transport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transport';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['time'], 'safe'],
            [['name', 'owner'], 'required'],
            [['name', 'owner'], 'string', 'max' => 15],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'transport_id' => 'Transport ID',
            'name' => 'Transportname',
            'owner' => 'Owner',
            'time' => 'Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbanks()
    {
        return $this->hasMany(Tbank::className(), ['transport_id' => 'transport_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVendors()
    {
        return $this->hasMany(Vendor::className(), ['transport_id' => 'transport_id']);
    }
}
