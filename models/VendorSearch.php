<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Vendor;

/**
 * VendorSearch represents the model behind the search form about `app\models\Vendor`.
 */
class VendorSearch extends Vendor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vendor_id', 'transport_id', 'user_id', 'is_active'], 'integer'],
            [['vendor_code', 'verdor_corp', 'time'], 'safe'],
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
        $query = Vendor::find();

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
            'vendor_id' => $this->vendor_id,
            'transport_id' => $this->transport_id,
            'user_id' => $this->user_id,
            'time' => $this->time,
            'is_active' => $this->is_active,
        ]);

        $query->andFilterWhere(['like', 'vendor_code', $this->vendor_code])
            ->andFilterWhere(['like', 'verdor_corp', $this->verdor_corp]);

        return $dataProvider;
    }
}
