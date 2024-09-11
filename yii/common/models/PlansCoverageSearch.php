<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PlansCoverage;

/**
 * PlansCoverageSearch represents the model behind the search form of `common\models\PlansCoverage`.
 */
class PlansCoverageSearch extends PlansCoverage
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'item_id'], 'integer'],
            [['YorN', 'description'], 'safe'],
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
    $query = PlansCoverage::find();

    $totalCount = $query->count();

    
    $dataProvider = new ActiveDataProvider([
        'query' => $query,
        'pagination' => [
            'pageSize' => 10, 
        ],
        'totalCount' => $totalCount, 
    ]);

    $this->load($params);

    
    if (!$this->validate()) {
        return $dataProvider;
    }


    $query->andFilterWhere([
        'id' => $this->id,
        'item_id' => $this->item_id,
    ]);

    $query->andFilterWhere(['like', 'YorN', $this->YorN])
          ->andFilterWhere(['like', 'description', $this->description]);

 
    $totalCount = $query->count();

 
    $dataProvider->query = $query;
    $dataProvider->totalCount = $totalCount;

    return $dataProvider;
}

}
