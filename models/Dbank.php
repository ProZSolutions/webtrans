<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dbank".
 *
 * @property integer $dbank_id
 * @property integer $driver_id
 * @property string $bank_name
 * @property integer $acc_no
 * @property string $branch
 * @property string $ifsc
 * @property integer $is_active
 * @property integer $user_id
 * @property string $time
 *
 * @property Driver $driver
 * @property User $user
 */
class Dbank extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dbank';
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
}
