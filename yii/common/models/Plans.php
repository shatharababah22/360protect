<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "plans".
 *
 * @property int $id
 * @property int $insurance_id
 * @property string $name
 * @property string|null $description
 * @property string|null $overview
 * @property int|null $max_age
 * @property int|null $min_age
 * @property string $plan_code
 *
 * @property Insurances $insurance
 * @property Pricing[] $pricings
 */
class Plans extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plans';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['insurance_id', 'name', 'plan_code'], 'required'],
            [['insurance_id', 'max_age', 'min_age'], 'integer'],
            [['description', 'overview','overview_ar', 'description_ar','name_ar'], 'string'],

            
            [['name', 'plan_code'], 'string', 'max' => 255],
            [['insurance_id'], 'exist', 'skipOnError' => true, 'targetClass' => Insurances::class, 'targetAttribute' => ['insurance_id' => 'id']],
            [['source_id'], 'exist', 'skipOnError' => true, 'targetClass' => InsuranceCountries::class, 'targetAttribute' => ['source_id' => 'id']],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'insurance_id' => Yii::t('app', 'Insurance Name'),
            'source_id' => Yii::t('app', 'Source Name'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'overview' => Yii::t('app', 'Overview'),
            'max_age' => Yii::t('app', 'Max Age'),
            'min_age' => Yii::t('app', 'Min Age'),
            'plan_code' => Yii::t('app', 'Plan Code'),

            'overview_ar'=>Yii::t('app', 'Overview (Arabic)'), 'description_ar'=>Yii::t('app', 'Description (Arabic)'),'name_ar'=>Yii::t('app', 'Name (Arabic)')

        ];
    }

    /**
     * Gets query for [[Insurance]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInsurance()
    {
        return $this->hasOne(Insurances::class, ['id' => 'insurance_id']);
    }

 
    public function getSource()
    {
        return $this->hasOne(InsuranceCountries::class, ['id'=>'source_id']);
    }




    /**
     * Gets query for [[Pricings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPricings()
    {
        return $this->hasMany(Pricing::class, ['plan_id' => 'id']);
    }


    public function getCoverage()
    {
        return $this->hasMany(Plans::class, ['plan_id' => 'id']);
    }
}
