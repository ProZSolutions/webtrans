<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property string $bill_type
 * @property string $corporation
 * @property string $user_type
 * @property integer $id
 * @property string $vehicle_type
 * @property string $route_name
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bill_type', 'vehicle_type'], 'string', 'max' => 10],
            [['corporation', 'user_type'], 'string', 'max' => 6],
            [['route_name'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bill_type' => 'Bill Type',
            'corporation' => 'Corporation',
            'user_type' => 'User Type',
            'id' => 'ID',
            'vehicle_type' => 'Vehicle Type',
            'route_name' => 'Route Name',
        ];
    }
}
