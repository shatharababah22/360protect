<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Policy;

/**
 * PolicySearch represents the model behind the search form of `common\models\Policy`.
 */
class PolicySearch extends Policy
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'customer_id', 'departure_date', 'return_date', 'status', 'created_at', 'updated_at', 'source'], 'integer'],
            [['from_airport', 'DepartCountryCode', 'going_to', 'ArrivalCountryCode', 'ProposalState', 'ItineraryID', 'PNR', 'PolicyNo', 'PolicyPurchasedDateTime', 'PolicyURLLink', 'status_description'], 'safe'],
            [['price'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Policy::find();

        // add conditions that should always apply here


        
        $totalCount = $query->count();
    
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'totalCount' => $totalCount
        ]);
    

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'customer_id' => $this->customer_id,
            'departure_date' => $this->departure_date,
            'return_date' => $this->return_date,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'source' => $this->source,
            'price' => $this->price,
        ]);

        $query->andFilterWhere(['like', 'from_airport', $this->from_airport])
            ->andFilterWhere(['like', 'DepartCountryCode', $this->DepartCountryCode])
            ->andFilterWhere(['like', 'going_to', $this->going_to])
            ->andFilterWhere(['like', 'ArrivalCountryCode', $this->ArrivalCountryCode])
            ->andFilterWhere(['like', 'ProposalState', $this->ProposalState])
            ->andFilterWhere(['like', 'ItineraryID', $this->ItineraryID])
            ->andFilterWhere(['like', 'PNR', $this->PNR])
            ->andFilterWhere(['like', 'PolicyNo', $this->PolicyNo])
            ->andFilterWhere(['like', 'PolicyPurchasedDateTime', $this->PolicyPurchasedDateTime])
            ->andFilterWhere(['like', 'PolicyURLLink', $this->PolicyURLLink])
            ->andFilterWhere(['like', 'status_description', $this->status_description]);

        return $dataProvider;
    }
}
