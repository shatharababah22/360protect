<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "discount_user".
 *
 * @property int $id
 * @property string|null $mobile
 * @property string|null $email
 * @property int|null $discount_id
 *
 * @property Discount $discount
 */
class DiscountUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'discount_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['discount_id'], 'integer'],
            [['mobile', 'email'], 'string', 'max' => 255],
            [['discount_id'], 'exist', 'skipOnError' => true, 'targetClass' => Discount::class, 'targetAttribute' => ['discount_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mobile' => 'Mobile',
            'email' => 'Email',
            'discount_id' => 'Discount ID',
        ];
    }

    /**
     * Gets query for [[Discount]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDiscount()
    {
        return $this->hasOne(Discount::class, ['id' => 'discount_id']);
    }
}
