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
 */
class CreateCourseForm extends Model
{

    public $start;
    public $duration;

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

        $course->end = date('Y-m-d', strtotime($this->start . $duration));

        return $course->save() ? $course : null;
    }
}
