<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "course".
 *
 * @property integer $courseID
 * @property string $start
 * @property integer $duration
 * @property string $end
 */
class Course extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'course';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start', 'duration', 'end'], 'required'],
            [['start', 'end'], 'safe'],
            [['duration'], 'integer'],
            ['duration', 'safe']
        ];

    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'courseID' => 'Course ID',
            'start' => 'Start',
            'duration' => 'Duration',
            'end' => 'End',
        ];
    }
}
