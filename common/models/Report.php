<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "report".
 *
 * @property integer $reportID
 * @property integer $courseID
 * @property integer $studentID
 * @property string $title
 * @property string $content
 * @property string $date
 *
 * @property Course $course
 * @property User $student
 */
class Report extends \yii\db\ActiveRecord
{
    /**
     * Initialize `$studentID`
     * @var `$courseID` string
     * @return Report
     */
    public static function create($courseID = null)
    {
        $report = new self();
        $report->studentID = Yii::$app->user->id;
        $report->date = date('Y-m-d');
        $report->courseID = $courseID;

        return $report;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'report';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['courseID', 'studentID', 'title', 'content', 'date'], 'required'],
            [['courseID', 'studentID'], 'integer'],
            [['content'], 'string'],
            [['date'], 'safe'],
            [['title'], 'string', 'max' => 150],
            [['courseID'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['courseID' => 'courseID']],
            [['studentID'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['studentID' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'reportID' => 'Report ID',
            'courseID' => 'Course ID',
            'studentID' => 'Student ID',
            'title' => 'Title',
            'content' => 'Content',
            'date' => 'Date',
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
