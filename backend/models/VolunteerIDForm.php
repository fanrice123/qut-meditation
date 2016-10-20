<?php

namespace backend\models;

use Yii;
use yii\base\Model;


/**
 * This is the fake model class of VolunteerID
 * @property integer $studentID
 */
class VolunteerIDForm extends Model
{
    public $studentID;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['studentID'], 'required'],
            [['studentID'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'studentID' => 'Student ID',
        ];
    }

}
