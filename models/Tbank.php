<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbank".
 *
 * @property integer $tbank_id
 * @property string $bank_name
 * @property integer $acc_no
 * @property string $branch
 * @property string $ifsc
 * @property integer $is_active
 * @property integer $user_id
 * @property string $time
 * @property integer $transport_id
 *
 * @property Cdeposit[] $cdeposits
 * @property Transport $transport
 * @property User $user
 */
class Tbank extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbank';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        [['acc_no','transport_id','bank_name','branch','ifsc'],'required'],
             array(
            'bank_name',
            'match', 'not' => true, 'pattern' => '/[^a-zA-Z\s]/',
            'message' => 'Invalid characters in Bank name.',
        ),
              array(
            'branch',
            'match', 'not' => true, 'pattern' => '/[^a-zA-Z\s]/',
            'message' => 'Invalid characters in Branch name.',
        ),
             array(
            'ifsc',
            'match', 'not' => true, 'pattern' => '/[^0-9a-zA-Z_-]/',
            'message' => 'Invalid characters in ifsc code.',
        ),
            // [['acc_no'], 'integer', 'integerOnly'=>true, 'max'=>5],
// [['acc_no'],  'integer', 'min'=>4, 'max'=>7],
// [['acc_no'],  'string'],


            [['acc_no', 'is_active', 'user_id', 'transport_id'], 'integer'],
            [['time'], 'safe'],
            [['bank_name'], 'string', 'max' => 18],
            [['branch'], 'string', 'max' => 20],
            [['ifsc'], 'string', 'max' => 12],
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
            'tbank_id' => 'Tbank ID',
            'bank_name' => 'Bank Name',
            'acc_no' => 'Acc No',
            'branch' => 'Branch',
            'ifsc' => 'Ifsc',
            'is_active' => 'Is Active',
            'user_id' => 'User ID',
            'time' => 'Time',
            'name' => 'Transport Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCdeposits()
    {
        return $this->hasMany(Cdeposit::className(), ['tbank_id' => 'tbank_id']);
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
