<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Lpayment;

/**
 * LpaymentSearch represents the model behind the search form about `app\models\Lpayment`.
 */
class LpaymentSearch extends Lpayment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['payment_id', 'trip_id', 'vehicle_id', 'tbank_id', 'card_id', 'user_id'], 'integer'],
            [['reference_no', 'payment_date', 'time'], 'safe'],
            [['total_frieght', 'card_amount'], 'number'],
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
        $query = Lpayment::find();

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
            'payment_id' => $this->payment_id,
            'trip_id' => $this->trip_id,
            'payment_date' => $this->payment_date,
            'total_frieght' => $this->total_frieght,
            'vehicle_id' => $this->vehicle_id,
            'tbank_id' => $this->tbank_id,
            'card_id' => $this->card_id,
            'card_amount' => $this->card_amount,
            'user_id' => $this->user_id,
            'time' => $this->time,
        ]);

        $query->andFilterWhere(['like', 'reference_no', $this->reference_no]);

        return $dataProvider;
    }
}
