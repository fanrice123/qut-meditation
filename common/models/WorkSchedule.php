<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "workschedule".
 *
 * @property integer $id
 * @property integer $courseID
 * @property integer $studentID
 * @property string $start
 * @property string $end
 * @property string $note
 *
 * @property Course $course
 * @property User $student
 */
class WorkSchedule extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'workschedule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['studentID', 'start', 'end'], 'required'],
            [['courseID', 'studentID'], 'integer'],
            [['courseID', 'start', 'end'], 'safe'],
            [['note'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'courseID' => 'Course ID',
            'studentID' => 'Student ID',
            'start' => 'Start',
            'end' => 'End',
            'note' => 'Note',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['courseID' => 'courseID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(User::className(), ['id' => 'studentID']);
    }
}
