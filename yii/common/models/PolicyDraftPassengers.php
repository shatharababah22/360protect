<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "policy_draft_passengers".
 *
 * @property int $id
 * @property int $draft_id
 * @property string $first_name
 * @property string|null $middle_name
 * @property string $last_name
 * @property string $gender
 * @property string $nationality
 * @property string $id_type
 * @property string $id_number
 * @property int $dob
 * @property string $country
 * @property string|null $city
 * @property string|null $warning
 * @property string|null $document_link
 * @property int $created_at
 * @property int $updated_at
 *
 * @property PolicyDraft $draft
 */
class PolicyDraftPassengers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'policy_draft_passengers';
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
            [['draft_id', 'first_name', 'last_name', 'gender', 'nationality', 'id_type', 'id_number', 'dob', 'country'], 'required'],
            [['draft_id',  'created_at', 'updated_at'], 'integer'],
            [['warning', 'document_link'], 'string'],
            [['first_name', 'last_name', 'nationality', 'id_number', 'country', 'city'], 'string', 'max' => 100],
            [['middle_name'], 'string', 'max' => 255],
            [['gender'], 'string', 'max' => 10],
            [['id_type'], 'string', 'max' => 50],
            [['draft_id'], 'exist', 'skipOnError' => true, 'targetClass' => PolicyDraft::class, 'targetAttribute' => ['draft_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'draft_id' => Yii::t('app', 'Draft ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'middle_name' => Yii::t('app', 'Middle Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'gender' => Yii::t('app', 'Gender'),
            'nationality' => Yii::t('app', 'Nationality'),
            'id_type' => Yii::t('app', 'Id Type'),
            'id_number' => Yii::t('app', 'Id Number'),
            'dob' => Yii::t('app', 'Dob'),
            'country' => Yii::t('app', 'Country'),
            'city' => Yii::t('app', 'City'),
            'warning' => Yii::t('app', 'Warning'),
            'document_link' => Yii::t('app', 'Document Link'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[Draft]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDraft()
    {
        return $this->hasOne(PolicyDraft::class, ['id' => 'draft_id']);
    }
}
