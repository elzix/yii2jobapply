<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * This is the model class for table "Applications".
 *
 * @property int $id
 * @property int $job
 * @property string $fname
 * @property string $lname
 * @property string $cv
 * @property string $letter
 * @property string $created
 */
class Application extends ActiveRecord
{
    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return '{{applications}}';
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
      return [
        // General attributes
        'id', 'job', 'fname', 'lname',
        // Files
        'cv', 'letter',
        // Dates
         'created',
        
      ];
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['job', 'fname', 'lname', 'cv', 'letter'], 'required'],
            [['cv'], 'file', 'skipOnEmpty' => false, 'extensions' => 'pdf,doc,docx'],
            [['letter'], 'file', 'skipOnEmpty' => false, 'extensions' => 'pdf,doc,docx'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function upload()
    {
        if ($this->validate()) {
            $this->cv->saveAs('uploads/' . $this->cv->baseName . '.' . $this->cv->extension);
            $this->letter->saveAs('uploads/' . $this->letter->baseName . '.' . $this->letter->extension);
            
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'fname' => 'First Name',
            'lname' => 'Last Name',
            'cv' => 'CV',
            'letter' => 'Cover Letter',
        ];
    }
}