<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transport".
 *
 * @property integer $transport_id
 * @property string $name
 * @property string $owner
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
            [['name', 'owner'], 'required'],
            [['name', 'owner'], 'string', 'max' => 15],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'transport_id' => 'Transport ID',
            'name' => 'Name',
            'owner' => 'Owner',
           
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
