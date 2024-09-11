<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pricing".
 *
 * @property int $id
 * @property int $plan_id
 * @property int $duration
 * @property string $passenger
 * @property float $price
 *
 * @property Plans $plan
 */
class Pricing extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pricing';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['plan_id', 'duration', 'passenger', 'price'], 'required'],
            ['status', 'required', 'when' => function($model) {
                return !empty($model->discount_price);
            }, 'whenClient' => "function (attribute, value) {
                return $('#yourmodel-discount_price').val() != '';
            }"],
            [['plan_id', 'duration'], 'integer'],
            [['price', 'discount_price'], 'number'],
            [['passenger'], 'string', 'max' => 255],
            [['status'], 'in', 'range' => [0, 1]], 
            [['plan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Plans::class, 'targetAttribute' => ['plan_id' => 'id']],
            [['discount_price'], 'compare', 'compareAttribute' => 'price', 'operator' => '<', 'type' => 'number', 'message' => 'Price must be greater than to Discount Price.'],

        ];
    }



    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            if ($this->discount_price == 0) {
                $this->status = 0; 
            }
            return true;
        }
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'plan_id' => Yii::t('app', 'Plan Code'),
            'duration' => Yii::t('app', 'Duration'),
            'passenger' => Yii::t('app', 'Passenger'),
            'price' => Yii::t('app', 'Price'),
            'discount_price' => Yii::t('app', 'Discount Price'), // Add this label
            'status' => Yii::t('app', 'Status'), // Add this label
        ];
    }
    /**
     * Gets query for [[Plan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlan()
    {
        return $this->hasOne(Plans::class, ['id' => 'plan_id']);
    }
}
