<?php

namespace app\models;

use yii\db\ActiveRecord;


/**
 * This is the model class for table "Jobs".
 *
 * @property int $id
 * @property string $job_title
 * @property string $job_desc
 * @property string $deadline
 * @property string $category
 * @property string $status
 * @property string $created
 */
class Job extends ActiveRecord
{    
    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return '{{jobs}}';
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
      return [
        // General attributes
        'id', 'job_title', 'job_desc', 'category', 'status',
        // Dates
        'deadline', 'created',
        
      ];
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['job_title', 'job_desc', 'deadline', 'category', 'status'], 'required'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'job_title' => 'Job Title',
            'job_desc' => 'Job Description',
        ];
    }
}