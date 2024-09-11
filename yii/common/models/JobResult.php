<?php 
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class JobResult extends ActiveRecord
{
    public static function tableName()
    {
        return 'job_result'; // Your table name
    }

    public function rules()
    {
        return [
            [['job_id', 'result'], 'required'],
            [['result'], 'string'],
            [['job_id'], 'integer'],
        ];
    }
}
