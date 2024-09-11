<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "upload".
 *
 * @property int $id
 * @property string $file_name
 * @property string $file_path
 * @property string $created_at
 */
class Upload extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'upload';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file_name', 'file_path'], 'required'],
            [['created_at'], 'safe'],
            [['file_name', 'file_path'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'file_name' => 'File Name',
            'file_path' => 'File Path',
            'created_at' => 'Created At',
        ];
    }
}
