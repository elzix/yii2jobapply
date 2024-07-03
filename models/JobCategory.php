<?php

namespace app\models;

use yii\db\ActiveRecord;


/**
 * This is the model class for table "Job Categories".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 */
class JobCategory extends ActiveRecord
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
        'id', 'name', 'description',
        
      ];
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name'], 'required'],
        ];
    }
}