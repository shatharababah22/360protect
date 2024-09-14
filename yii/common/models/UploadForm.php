<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "upload".
 *
 * @property int $id
 * @property string $file_name
 * @property string $file_path
 * @property string $created_at
 */
class UploadForm extends \yii\db\ActiveRecord
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
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
 
            $fileName = $this->imageFile->baseName . '_' . time() . '.' . $this->imageFile->extension;
         
            $this->imageFile->saveAs('images/' . $fileName);
            return true;
        } else {
            return false;
        }
    }
    
    }

