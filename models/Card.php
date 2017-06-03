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
         [['corp', 'vehicle_id', 'card_no','cust_id'],'required'],

          array(
            'card_no',
            'match', 'not' => true, 'pattern' => '/[^0-9a-zA-Z_-]/',
            'message' => 'Invalid characters in card no.',
        ),
      
            array(
            'cust_id',
            'match', 'not' => true, 'pattern' => '/[^0-9a-zA-Z_-]/',
            'message' => 'Invalid characters in Customer Id.',
        ),
            [['corp'], 'string'],
            [['vehicle_id', 'is_active'], 'integer'],
            // [['vehicle_id'],'max'=>3],
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
            'vehicle_id' => 'Vehicle Name',
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
