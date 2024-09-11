<?php
namespace common\models;

use Yii;

/**
 * This is the model class for table "countries".
 *
 * @property int $id
 * @property string $code
 * @property string $country
 * @property float|null $callCode
 * @property string $zone
 * @property string|null $currency
 * @property int $active
 * @property Airports[] $airports
 */

class Countries extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'countries';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'mobile_ex', 'call_key', 'name_en', 'name_ar', 'active_orders', 'sort', 'active'], 'required'],
            [['active_orders', 'sort', 'active'], 'integer'],
            [['code'], 'string', 'max' => 2],
            [['mobile_ex'], 'string', 'max' => 20],
            [['call_key'], 'string', 'max' => 5],
            [['name_en', 'name_ar'], 'string', 'max' => 100],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Code'),
            'mobile_ex' => Yii::t('app', 'Mobile Ex'),
            'call_key' => Yii::t('app', 'Call Key'),
            'name_en' => Yii::t('app', 'Name (English)'),
            'name_ar' => Yii::t('app', 'Name (Arabic)'),
            'active_orders' => Yii::t('app', 'Active Orders'),
            'sort' => Yii::t('app', 'Sort'),
            'active' => Yii::t('app', 'Active'),
        ];
    }
    

    /**
     * Gets query for [[Airports]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAirports()
    {
        return $this->hasMany(Airports::class, ['country_id' => 'id']);
    }
}
