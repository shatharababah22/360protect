<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "insurances".
 *
 * @property int $id
 * @property string $name
 * @property string|null $overview
 * @property string|null $description
 * @property string $photo
 * @property float $price
 * @property string|null $benefits_link
 *
 * @property InsuranceCountries[] $insuranceCountries
 * @property Plans[] $plans
 */
class Insurances extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'insurances';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','photo','price'], 'required'],
            [['photo'], 'file',  'extensions' => 'png, jpg, jpeg'],
            [['benefits_link'], 'file'],
            [['overview', 'description','name','overview_ar', 'description_ar','name_ar'], 'string'],
            [['price'], 'number'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function behaviors()
{
    return [
        [
            'class' => SluggableBehavior::class,
                'attribute' => 'name', 
                'slugAttribute' => 'slug'
            
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
            'name' => Yii::t('app', 'Name'),
            'overview' => Yii::t('app', 'Overview'),
            'description' => Yii::t('app', 'Description'),
            'photo' => Yii::t('app', 'Photo'),
            'price' => Yii::t('app', 'Price'),
            'benefits_link' => Yii::t('app', 'Policy Wording'),
            'overview_ar'=>Yii::t('app', 'Overview (Arabic)'),
              'description_ar'=>Yii::t('app', 'Description (Arabic)'),
             'name_ar'=>Yii::t('app', 'Name (Arabic)')
        ];
    }

    /**
     * Gets query for [[InsuranceCountries]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInsuranceCountries()
    {
        return $this->hasMany(InsuranceCountries::class, ['insurance_id' => 'id']);
    }

    /**
     * Gets query for [[Plans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlans()
    {
        return $this->hasMany(Plans::class, ['insurance_id' => 'id']);
    }

    public function getItem()
    {
        return $this->hasMany(Insurances::class, ['insurance_id' => 'id']);
    }
}
