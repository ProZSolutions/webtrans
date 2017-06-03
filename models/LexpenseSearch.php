<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Lexpense;

/**
 * LexpenseSearch represents the model behind the search form about `app\models\Lexpense`.
 */
class LexpenseSearch extends Lexpense
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trip_id', 'expense_id', 'load_wages', 'phone', 'spare', 'cliner', 'driver', 'toll', 'rto', 'other'], 'integer'],
            [['time'], 'safe'],
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
        $query = Lexpense::find();

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
            'expense_id' => $this->expense_id,
            'load_wages' => $this->load_wages,
            'phone' => $this->phone,
            'spare' => $this->spare,
            'cliner' => $this->cliner,
            'driver' => $this->driver,
            'toll' => $this->toll,
            'rto' => $this->rto,
            'other' => $this->other,
            'time' => $this->time,
        ]);

        return $dataProvider;
    }
}
