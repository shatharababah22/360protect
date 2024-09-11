<?php
namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Plans;

/**
 * PlansSearch represents the model behind the search form of `common\models\Plans`.
 */
class PlansSearch extends Plans
{
    /**
     * {@inheritdoc}
     */
    public $insurance_name;

    public function rules()
    {
        return [
            [['id', 'max_age', 'min_age'], 'integer'],
            [['name', 'description', 'overview', 'plan_code', 'insurance_name'], 'safe'],
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
        $query = Plans::find();
    
        // Join with the 'insurance' relation
        $query->joinWith(['insurance']);
    
        $this->load($params);
    
        if (!$this->validate()) {
            // If validation fails, return a data provider with no records
            $query->where('0=1');
            return new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => 10,
                ],
                'totalCount' => 0,
            ]);
        }

        $query->andFilterWhere([
            'plans.id' => $this->id,
            'plans.max_age' => $this->max_age,
            'plans.min_age' => $this->min_age,
        ]);
    
        $query->andFilterWhere(['like', 'plans.name', $this->name])
            ->andFilterWhere(['like', 'plans.description', $this->description])
            ->andFilterWhere(['like', 'plans.overview', $this->overview])
            ->andFilterWhere(['like', 'plans.plan_code', $this->plan_code])
            ->andFilterWhere(['like', 'insurances.name', $this->insurance_name]);
    
      
        $totalCount = $query->count();
    
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'totalCount' => $totalCount,
        ]);
    
        // Define sorting attributes for 'insurance_name'
        $dataProvider->sort->attributes['insurance_name'] = [
            'asc' => ['insurances.name' => SORT_ASC],
            'desc' => ['insurances.name' => SORT_DESC],
        ];
    
        return $dataProvider;
    }
    
}
