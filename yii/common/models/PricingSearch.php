<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Pricing;

/**
 * PricingSearch represents the model behind the search form of `common\models\Pricing`.
 */
class PricingSearch extends Pricing
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'plan_id', 'duration'], 'integer'],
            [['passenger'], 'safe'],
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
    $query = Pricing::find();

    $this->load($params);

    if (!$this->validate()) {
    
        $query->where('0=1');
        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
    }

    
    $query->andFilterWhere([
        'id' => $this->id,
        'plan_id' => $this->plan_id,
        'duration' => $this->duration,
        'price' => $this->price,
    ]);

    $query->andFilterWhere(['like', 'passenger', $this->passenger]);

    $totalCount = $query->count();

    $dataProvider = new ActiveDataProvider([
        'query' => $query,
        'pagination' => [
            'pageSize' => 10,
        ],
        'totalCount' => $totalCount,
    ]);

    return $dataProvider;
}

}
