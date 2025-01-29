<?php

namespace common\models;

use common\models\PaymentMethod;

use Yii;

/**
 * This is the model class for table "customers".
 *
 * @property int $id
 * @property string|null $name
 * @property string $mobile
 * @property string $email
 * @property string $country
 */
class Customers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mobile', 'email','credit'], 'required'],
            [['name', 'email'], 'string', 'max' => 255],
            [['mobile', 'country'], 'string', 'max' => 100],
            [['credit'], 'number'],
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
            'mobile' => Yii::t('app', 'Mobile'),
            'email' => Yii::t('app', 'Email'),
            'country' => Yii::t('app', 'Country'),
            'credit' => Yii::t('app', 'Credit'),
        ];
    }


    public function getPolicy()
    {
        return $this->hasOne(Policy::class, ['customer_id' => 'id']);
    }


    public function getPaymentMethod()
    {
        return $this->hasMany(PaymentMethod::class, ['customer_id' => 'id']);
    }
}
