<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Card;

/**
 * CardSearch represents the model behind the search form about `app\models\Card`.
 */
class CardSearch extends Card
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['card_id', 'vehicle_id', 'is_active'], 'integer'],
            [['card_no', 'corp', 'cust_id'], 'safe'],
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
        $query = Card::find();

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
            'card_id' => $this->card_id,
            'vehicle_id' => $this->vehicle_id,
            'is_active' => $this->is_active,
        ]);

        $query->andFilterWhere(['like', 'card_no', $this->card_no])
            ->andFilterWhere(['like', 'corp', $this->corp])
            ->andFilterWhere(['like', 'cust_id', $this->cust_id])
            ->andWhere(['is_active'=> 1]);

        return $dataProvider;
    }
}
