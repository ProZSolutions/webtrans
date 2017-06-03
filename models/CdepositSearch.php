<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cdeposit;

/**
 * CdepositSearch represents the model behind the search form about `app\models\Cdeposit`.
 */
class CdepositSearch extends Cdeposit
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cdeposit_id', 'card_id', 'vehicle_id', 'tbank_id', 'user_id'], 'integer'],
            [['amount'], 'number'],
            [['date', 'time', 'deposit_by'], 'safe'],
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
        $query = Cdeposit::find();

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
            'cdeposit_id' => $this->cdeposit_id,
            'card_id' => $this->card_id,
            'amount' => $this->amount,
            'date' => $this->date,
            'time' => $this->time,
            'vehicle_id' => $this->vehicle_id,
            'tbank_id' => $this->tbank_id,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'deposit_by', $this->deposit_by]);

        return $dataProvider;
    }
}
