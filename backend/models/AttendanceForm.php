<?php

namespace backend\models;

use Yii;
use yii\web\UploadedFile;
use yii\base\Model;
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
class AttendanceForm extends Model
{
    public $courseID;
    public $date;
    public $file;
    public $day;
    public $isNewRecord;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attandance';
    }

    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $this->isNewRecord = false;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['courseID', 'date', 'day', 'file'], 'required'],
            [['courseID', 'day'], 'integer'],
            ['date', 'date', 'format' => 'yyyy-mm-dd'],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf', 'wrongExtension'=>'pdf file only', 'maxSize' => 10 * 1024 * 1024],
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

    /**
     * Save data into Attendance `ActiveRecord`
     *
     * @param bool $flag set false if not intend to store the data
     * @return bool
     */
    public function saveData($flag = true)
    {
        $path = 'course_'.$this->courseID.'/';
        if (!file_exists($path))
            mkdir($path, 0777);
        $newFilePath = $path.Yii::$app->security->generateRandomString() . '.' . $this->file->extension;
        if ($this->file->saveAs($newFilePath)) {
            $attendance = new Attendance();
            $attendance->courseID = $this->courseID;
            $attendance->date = $this->date;
            $attendance->file = $newFilePath;

            if ($flag)
                return $attendance->save();
            else
                return true;
        }
        return false;
    }
}
