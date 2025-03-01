<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Discount;

/**
 * DiscountSearch represents the model behind the search form of `common\models\Discount`.
 */
class DiscountSearch extends Discount
{
    /**
     * {@inheritdoc}
     */

     public $insurance_name;
    public function rules()
    {
        return [
            [['id', 'discount_percentage', 'insurance_id', 'created_at', 'updated_at'], 'integer'],
            [['promo_code', 'insurance_name'], 'safe'],
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
        $query = Discount::find();
        $query->joinWith(['insurance']);
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
            'id' => $this->id,
            'discount_percentage' => $this->discount_percentage,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'promo_code', $this->promo_code])
        ->andFilterWhere(['like', 'insurances.name', $this->insurance_name]);

        return $dataProvider;
    }
}
