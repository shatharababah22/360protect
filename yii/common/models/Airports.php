<?php
namespace common\models;

use Yii;

/**
 * This is the model class for table "airports".
 *
 * @property int $id
 * @property string|null $code
 * @property string|null $name
 * @property string|null $cityCode
 * @property string|null $cityName
 * @property string|null $countryName
 * @property string|null $countryCode
 * @property int|null $country_id
 */
class Airports extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'airports';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name', 'cityCode', 'cityName','countryCode','countryCode'], 'required'],
            [['code', 'cityCode'], 'string', 'max' => 50],
            [['name', 'cityName'], 'string', 'max' => 200],
            // [['country_id'], 'integer'],
            // [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::class, 'targetAttribute' => ['country_id' => 'id']],
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
            'name' => Yii::t('app', 'Name'),
            'cityCode' => Yii::t('app', 'City Code'),
            'cityName' => Yii::t('app', 'City Name'),
            'countryName' => Yii::t('app', 'Country Name'),
            'countryCode' => Yii::t('app', 'Country Code'),
            // 'country_id' => Yii::t('app', 'Country Name'),
        ];
    }

    /**
     * Gets query for [[Country]].
     *
     * @return \yii\db\ActiveQuery
     */
    // public function getCountry()
    // {
    //     return $this->hasOne(Countries::class, ['id' => 'country_id']);
    // }


    public static function getCountryCodeByAirportCode($airportCode)
    {
        return self::find()
            ->joinWith('country')
            ->where(['airports.code' => $airportCode])
            ->select('countries.country')
            ->scalar();

            // ->scalar(); ->one();

    }
}
