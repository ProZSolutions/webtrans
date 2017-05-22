<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BillList;

/**
 * BillListSearch represents the model behind the search form about `app\models\BillList`.
 */
class BillListSearch extends BillList
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vehicle_id', 'bill_id', 'user_id'], 'integer'],
            [['type', 'from', 'to', 'paid_date', 'num', 'time'], 'safe'],
            [['amount'], 'number'],
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
        $query = BillList::find();

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
            'bill_id' => $this->bill_id,
            'from' => $this->from,
            'to' => $this->to,
            'amount' => $this->amount,
            'paid_date' => $this->paid_date,
            'user_id' => $this->user_id,
            'time' => $this->time,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'num', $this->num]);

        return $dataProvider;
    }
}
