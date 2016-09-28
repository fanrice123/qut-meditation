<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "volunteer".
 *
 * @property integer $studentID
 * @property integer $courseID
 *
 * @property User $student
 * @property Course $course
 */
class Volunteer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'volunteer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['studentID', 'courseID'], 'required'],
            [['studentID', 'courseID'], 'integer'],
            [['studentID'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['studentID' => 'id']],
            [['courseID'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['courseID' => 'courseID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'studentID' => 'Student ID',
            'courseID' => 'Course ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(User::className(), ['id' => 'studentID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['courseID' => 'courseID']);
    }
}
