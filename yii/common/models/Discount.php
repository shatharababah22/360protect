<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "discount".
 *
 * @property int $id
 * @property int $discount_percentage
 * @property string $promo_code
 * @property int $insurance_id
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Insurances $insurance
 */
class Discount extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'discount';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['discount_percentage', 'promo_code', 'insurance_id'], 'required'],
            [['discount_percentage', 'insurance_id', 'created_at', 'updated_at'], 'integer'],
            [['promo_code'], 'string', 'max' => 255],
            [['insurance_id'], 'exist', 'skipOnError' => true, 'targetClass' => Insurances::class, 'targetAttribute' => ['insurance_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'discount_percentage (%)' => 'Discount Percentage',
            'promo_code' => 'Promo Code',
            'insurance_id' => 'Insurance Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
}
