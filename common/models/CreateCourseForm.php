<?php

namespace common\models;

use Yii;
use yii\base\Model;
use backend\validators\DateRangeValidator;

/**
 * This is the model class for table "course".
 *
 * @property string $start
 * @property integer $duration
 * @property string $end
 * @property integer $student_max
 * @property integer $waitList
 */
class CreateCourseForm extends Model
{
    public $start;
    public $duration;
    public $student_max;
    public $waitList;

    public function __construct(array $config = [])
    {
        $this->start = date('Y-m-d', strtotime('+2 day'));
        $this->student_max = 20;
        $this->waitList = 10;
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'courseID' => 'Course ID',
            'start' => 'Start',
            'duration' => 'Course Duration',
            'end' => 'End',
            'student_max' => 'Maximum Number of Student',
            'waitList' => 'Maximum number of student in waitlist',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start', 'duration', 'waitList', 'student_max'], 'required'],
            [['duration'], 'integer'],
            ['start', 'date', 'format' => 'yyyy-mm-dd'],
            ['start', 'unique', 'targetClass' => '\common\models\Course', 'message' => 'There is already a course conducting on that day.'],
            ['start', DateRangeValidator::className()],
            ['student_max', 'integer', 'min' => 3, 'max' => 100],
            ['waitList', 'integer', 'min' => 0, 'max' => 300],

            //[['start', 'end', 'duration'], 'safe']
        ];
    }



    /**
     * @inheritdoc
     */
    public function createCourse()
    {
        if (!$this->validate()) {
            return null;
        }
        $course = new Course();
        $course->start = $this->start;
        //$course->duration = $this->duration;

        $temp = $this->duration;
        $course->duration = $temp;
        $duration = ($temp - 1);
        $duration = ' + '.$duration;
        $duration = $duration.' days';
        $course->student_max = $this->student_max;
        $course->waitList = $this->waitList;

        $course->end = date('Y-m-d', strtotime($this->start . $duration));

        return $course->save() ? $course : null;
    }
}
