<?php

namespace common\models;

use Yii;
use yii\base\Model;
use backend\validators\DateRangeValidator;

/**
 * This is the model class for table "course".
 *
 * @property integer $courseID
 * @property string $start
 * @property integer $duration
 * @property string $end
 * @property integer $student_max
 */
class CreateCourseForm extends Model
{
    public $start;
    public $duration;
    public $student_max;

    public function __construct(array $config = [])
    {
        $this->student_max = 20;
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
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start', 'duration'], 'required'],
            [['duration'], 'integer'],
            ['start', 'date', 'format' => 'yyyy-mm-dd'],
            ['start', 'unique', 'targetClass' => '\common\models\Course', 'message' => 'There is already a course conducting on that day.'],
            ['start', DateRangeValidator::className()],
            ['student_max', 'integer', 'min' => 3, 'max' => 100],

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

        $course->end = date('Y-m-d', strtotime($this->start . $duration));

        return $course->save() ? $course : null;
    }
}
