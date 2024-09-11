<?php

namespace common\models;
use yii\behaviors\SluggableBehavior;

use Yii;

/**
 * This is the model class for table "insurance_countries".
 *
 * @property int $id
 * @property int $insurance_id
 * @property string $country_code
 * @property string $company_name
 * @property string $company_logo
 * @property string $source_country
 * @property string $source_country_code
 *
 * @property Insurances $insurance
 */
class InsuranceCountries extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'insurance_countries';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['insurance_id', 'country_code', 'company_name', 'company_logo', 'source_country', 'source_country_code'], 'required'],
            [['insurance_id'], 'integer'],
            [['company_logo'], 'string'],
            [['country_code', 'source_country_code'], 'string', 'max' => 100],
            [['company_name', 'source_country','source_country_ar'], 'string', 'max' => 255],
            [['insurance_id'], 'exist', 'skipOnError' => true, 'targetClass' => Insurances::class, 'targetAttribute' => ['insurance_id' => 'id']],
        ];
    }
    public function behaviors()
{
    return [
        [
            'class' => SluggableBehavior::class,
                'attribute' => 'source_country', 
                'slugAttribute' => 'slug',
                // 'ensureUnique' => false,
        ],
    ];
}
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'insurance_id' => Yii::t('app', 'Insurance name'),
            'country_code' => Yii::t('app', 'Country Code'),
            'company_name' => Yii::t('app', 'Company Name'),
            'company_logo' => Yii::t('app', 'Company Logo'),
            'source_country' => Yii::t('app', 'Source Country'),
            'source_country_code' => Yii::t('app', 'Source Country Code'),
            'source_country_ar'=> Yii::t('app', 'Source Country')
        ];
    }


    public static function getAllSourceCountries()
    {
        return self::find()
            ->select('source_country')
            ->distinct() 
            ->column();
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



    public function getPlans()
    {
        return $this->hasMany(Plans::class, ['countries_id' => 'id']);
    }


}
