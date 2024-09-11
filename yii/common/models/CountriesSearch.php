<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Countries;

/**
 * CountriesSearch represents the model behind the search form of `common\models\Countries`.
 */
class CountriesSearch extends Countries
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'active_orders', 'sort', 'active'], 'integer'],
            [['code', 'name_en', 'name_ar', 'mobile_ex', 'call_key'], 'safe'],
            [['call_key'], 'string', 'max' => 5], 
            [['mobile_ex'], 'string', 'max' => 20], 
            [['active'], 'boolean'],
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
        $query = Countries::find();
    
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
            'call_key' => $this->call_key,
            'active_orders' => $this->active_orders,
            'sort' => $this->sort,
            'active' => $this->active,
        ]);
    
        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name_en', $this->name_en])
            ->andFilterWhere(['like', 'name_ar', $this->name_ar]);
    
        $totalCount = $query->count();
    
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
    
        $dataProvider->pagination->totalCount = $totalCount;
    
        return $dataProvider;
    }
}    
