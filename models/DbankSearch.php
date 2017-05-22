<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Dbank;

/**
 * DbankSearch represents the model behind the search form about `app\models\Dbank`.
 */
class DbankSearch extends Dbank
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dbank_id', 'driver_id', 'acc_no', 'is_active', 'user_id'], 'integer'],
            [['bank_name', 'branch', 'ifsc', 'time'], 'safe'],
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
        $query = Dbank::find();

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
            'dbank_id' => $this->dbank_id,
            'driver_id' => $this->driver_id,
            'acc_no' => $this->acc_no,
            'is_active' => $this->is_active,
            'user_id' => $this->user_id,
            'time' => $this->time,
        ]);

        $query->andFilterWhere(['like', 'bank_name', $this->bank_name])
            ->andFilterWhere(['like', 'branch', $this->branch])
            ->andFilterWhere(['like', 'ifsc', $this->ifsc]);

        return $dataProvider;
    }
}
