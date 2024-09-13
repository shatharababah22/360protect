<?php
namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PlansItems;
use common\models\Plans;

/**
 * PlansItemsSearch represents the model behind the search form of `common\models\PlansItems`.
 */
class PlansItemsSearch extends PlansItems
{


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id','insurance_id'], 'integer'],
            [['title'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
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
        $query = PlansItems::find();
    
       
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
            'insurance_id' => $this->insurance_id
        ]);
    
        $query->andFilterWhere(['like', 'title', $this->title]);
              
    
        $totalCount = $query->count();
    
        $dataProvider->query = $query;
        $dataProvider->totalCount = $totalCount;
    
        return $dataProvider;
    }
    
}
