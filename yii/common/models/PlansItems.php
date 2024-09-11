<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "plans_items".
 *
 * @property int $id
 * @property string $title
 *
 * @property PlansCoverage[] $plansCoverages
 */
class PlansItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plans_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title','insurance_id'], 'required'],
            [['insurance_id'], 'integer'],
            [['title','title_ar'], 'string', 'max' => 255],
            [['insurance_id'], 'exist', 'skipOnError' => true, 'targetClass' => Insurances::class, 'targetAttribute' => ['insurance_id' => 'id']]


        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'title_ar'=> Yii::t('app', 'Title'),
            'insurance_id' => Yii::t('app', 'Insurance Name'),
        ];
    }

    /**
     * Gets query for [[PlansCoverages]].
     *
     * @return \yii\db\ActiveQuery
     */
    // public function getCoverages()
    // {
    //     return $this->hasMany(PlansCoverage::class, ['item_id' => 'id']);
    // }
    public function getCoverages()
    {
        return $this->hasMany(PlansCoverage::class, ['item_id' => 'id']);
    }
    public function getInsurance()
    {
        return $this->hasOne(Insurances::class, ['id' => 'insurance_id']);
    }


}
