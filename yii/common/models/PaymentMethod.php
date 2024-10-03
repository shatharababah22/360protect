<?php

namespace common\models;

use common\models\Customers;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "paymentmethods".
 *
 * @property int $id
 * @property string|null $method
 * @property int $customer_id
 * @property string|null $response
 *
 * @property Customers $customer
 */
class PaymentMethod extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%paymentmethods}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id'], 'required'],
            [['customer_id'], 'integer'],
            [['method', 'response'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'method' => 'Payment Method',
            'customer_id' => 'Customer ID',
            'response' => 'Response',
        ];
    }

    /**
     * Gets query for [[Customer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customers::class, ['id' => 'customer_id']);
    }
}
