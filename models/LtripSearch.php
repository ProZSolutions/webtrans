<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ltrip;

/**
 * LtripSearch represents the model behind the search form about `app\models\Ltrip`.
 */
class LtripSearch extends Ltrip
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vehicle_id', 'trip_id', 'driver_id', 'total_km', 'corp_km', 'payment_id', 'user_id'], 'integer'],
            [['load_date', 'origin', 'destination', 'unloaded_date', 'time'], 'safe'],
            [['load_weight', 'trip_diesel', 'diesel_amount', 'trip_advance', 'trip_expenses', 'frieght', 'trip_profit'], 'number'],
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
        $query = Ltrip::find();

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
            'vehicle_id' => $this->vehicle_id,
            'trip_id' => $this->trip_id,
            'driver_id' => $this->driver_id,
            'load_date' => $this->load_date,
            'total_km' => $this->total_km,
            'corp_km' => $this->corp_km,
            'load_weight' => $this->load_weight,
            'trip_diesel' => $this->trip_diesel,
            'diesel_amount' => $this->diesel_amount,
            'unloaded_date' => $this->unloaded_date,
            'trip_advance' => $this->trip_advance,
            'trip_expenses' => $this->trip_expenses,
            'frieght' => $this->frieght,
            'trip_profit' => $this->trip_profit,
            'payment_id' => $this->payment_id,
            'time' => $this->time,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'origin', $this->origin])
            ->andFilterWhere(['like', 'destination', $this->destination]);

        return $dataProvider;
    }
}
