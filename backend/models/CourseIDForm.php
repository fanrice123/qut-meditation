<?php

namespace backend\models;

use Yii;
use yii\base\Model;


/**
 * This is the fake model class of CourseID
 * @property integer $courseID
 */
class CourseIDForm extends Model
{
    public $courseID;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['courseID'], 'required'],
            [['courseID'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'courseID' => 'Course ID',
        ];
    }

}
