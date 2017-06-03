<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ldiesel;

/**
 * LdieselSearch represents the model behind the search form about `app\models\Ldiesel`.
 */
class LdieselSearch extends Ldiesel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trip_id', 'ldiesel_id', 'card_id'], 'integer'],
            [['fill_date', 'payment_mode', 'time', 'place'], 'safe'],
            [['diesel_price', 'total_diesel', 'diesel_amount'], 'number'],
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
        $query = Ldiesel::find();

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
            'trip_id' => $this->trip_id,
            'ldiesel_id' => $this->ldiesel_id,
            'card_id' => $this->card_id,
            'fill_date' => $this->fill_date,
            'diesel_price' => $this->diesel_price,
            'total_diesel' => $this->total_diesel,
            'diesel_amount' => $this->diesel_amount,
            'time' => $this->time,
        ]);

        $query->andFilterWhere(['like', 'payment_mode', $this->payment_mode])
            ->andFilterWhere(['like', 'place', $this->place]);

        return $dataProvider;
    }
}
