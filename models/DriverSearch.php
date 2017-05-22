<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Driver;

/**
 * DriverSearch represents the model behind the search form about `app\models\Driver`.
 */
class DriverSearch extends Driver
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['driver_id', 'is_active', 'user_id', 'vehicle_id'], 'integer'],
            [['name', 'license_no', 'expiry', 'address', 'contact', 'refrence', 'license_type', 'join_date', 'time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Driver::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'driver_id' => $this->driver_id,
            'expiry' => $this->expiry,
            'join_date' => $this->join_date,
            'is_active' => $this->is_active,
            'user_id' => $this->user_id,
            'time' => $this->time,
            'vehicle_id' => $this->vehicle_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'license_no', $this->license_no])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'contact', $this->contact])
            ->andFilterWhere(['like', 'refrence', $this->refrence])
            ->andFilterWhere(['like', 'license_type', $this->license_type]);

        return $dataProvider;
    }
}
