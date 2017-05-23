<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "card".
 *
 * @property integer $card_id
 * @property string $card_no
 * @property string $corp
 * @property integer $vehicle_id
 * @property string $cust_id
 * @property integer $is_active
 *
 * @property Cdeposit[] $cdeposits
 */
class Card extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'card';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['corp'], 'string'],
            [['vehicle_id', 'is_active'], 'integer'],
            [['card_no', 'cust_id'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'card_id' => 'Card ID',
            'card_no' => 'Card No',
            'corp' => 'Corp',
            'vehicle_id' => 'Vehicle ID',
            'cust_id' => 'Cust ID',
            'is_active' => 'Is Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCdeposits()
    {
        return $this->hasMany(Cdeposit::className(), ['card_id' => 'card_id']);
    }
}
