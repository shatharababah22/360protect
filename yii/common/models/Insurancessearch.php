<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Insurances;

/**
 * Insurancessearch represents the model behind the search form of `common\models\Insurances`.
 */
class Insurancessearch extends Insurances
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'overview', 'description', 'photo', 'benefits_link'], 'safe'],
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
        $query = Insurances::find();
    
        // Load the search form data and validate
        $this->load($params);
    
        if (!$this->validate()) {
            $query->where('0=1');
            return new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => 10,
                ],
                'totalCount' => 0
            ]);
        }
    
     
        $query->andFilterWhere([
            'id' => $this->id,
            'price' => $this->price,
        ]);
    
        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'overview', $this->overview])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'benefits_link', $this->benefits_link]);
    
        
        $totalCount = $query->count();
    
      
        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'totalCount' => $totalCount
        ]);
    }
    
}
