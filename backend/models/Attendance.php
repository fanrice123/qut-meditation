<?php

namespace backend\models;

use Yii;
use yii\web\UploadedFile;
use yii\db\ActiveRecord;
use common\models\Course;

/**
 * This is the model class for table "attandance".
 *
 * @property integer $id
 * @property integer $courseID
 * @property integer $date
 * @property resource $file
 * @property integer $day
 * @property Course $course
 */
class Attendance extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attandance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['courseID', 'date', 'file'], 'required'],
            [['courseID', 'day'], 'integer'],
            ['date', 'date', 'format' => 'yyyy-mm-dd'],
            [['file'], 'string'],
            [['courseID'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['courseID' => 'courseID']],
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
            'date' => 'Date',
            'day' => 'Day',
            'file' => 'Attendance Sheet',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['courseID' => 'courseID']);
    }

}
