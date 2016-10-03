<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use kartik\grid\GridView;
use common\models\Course;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider; */
/* @var $form ActiveForm */

$this->title = 'Course List';
$this->params['breadcrumbs'][] = 'Course';
$this->params['fluid'] = true;

?>
<div class="course">


    <div class="col-lg-10" id="body">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'showPageSummary' => false,
            'striped' => true,
            'hover' => true,
            'export' => false,
            'panel'=>[
                'heading'=>'<i class="glyphicon glyphicon-calendar"></i> Courses Available',
                'type'=>'primary'
            ],
            'columns' => [
                ['class' => 'kartik\grid\SerialColumn'],
                [
                    'attribute' => 'courseID',
                    'vAlign' => 'middle',
                    'hAlign' => 'center',
                    'width' => '120px',
                ],
                [
                    'attribute' => 'course_start',
                    'width' => '250px',
                    'hAlign' => 'right',
                    'vAlign' => 'middle',
                    'value' => function($model, $key, $index, $widget) {
                        return $model->start;
                    }
                ],
                [
                    'attribute' => 'duration_(days)',
                    'width' => '120px',
                    'vAlign' => 'middle',
                    'hAlign' => 'center',
                    'value' => function ($model, $key, $index, $widget) {
                        return $model->duration;
                    }
                ],
                [
                    'attribute' => 'course_end',
                    'width' => '250px',
                    'vAlign' => 'middle',
                    'hAlign' => 'right',
                    'value' => function($model, $key, $index, $widget) {
                        return $model->end;
                    }
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{enroll}',
                    'options' => ['style' => 'width:20%'],
                    'buttons' => [
                        'enroll' => function ($url, $model) {
                            if (Yii::$app->user->isGuest) {
                                return Html::a('Enroll Now',
                                                ['/site/enroll', 'id' => $model->courseID, 'startDate' => $model->start, 'endDate' => $model->end],
                                                [
                                                    'class' => 'list-group-item list-group-item-success',
                                                    'title' => 'Enroll the course now!'
                                                ]
                                );
                            } else {
                                $isOldStudent = (new \yii\db\Query())->select('studentID')
                                    ->from('classtable c')
                                    ->innerJoin('course', 'c.courseID=course.courseID')
                                    ->where(['studentID' => Yii::$app->user->identity->id])
                                    ->andWhere('DATE(end) <= CURDATE()')->one();
                                if (!empty($isOldStudent)) {
                                    $result = common\models\Student::find()->where(['courseID' => $model->courseID, 'studentID' => Yii::$app->user->identity->id])->all();
                                    return empty($result) ? Html::a(
                                        'Enroll Now',
                                        ['/site/enroll', 'id' => $model->courseID, 'startDate' => $model->start, 'endDate' => $model->end],
                                        [
                                            'class' => 'list-group-item list-group-item-success',
                                            'title' => 'Enroll the course now!'
                                        ]
                                    ) : '<a href="#" title="You have already enrolled this course." class="list-group-item disabled">Enrolled</a>';
                                } else {
                                    return $model['duration']==10 ? Html::a(
                                        'Enroll Now',
                                        ['/site/enroll', 'id' => $model->courseID, 'startDate' => $model->start, 'endDate' => $model->end],
                                        [
                                            'class' => 'list-group-item list-group-item-success',
                                            'title' => 'Enroll the course now!'
                                        ]
                                    ) : '<a href="#" title="You have to enroll and complete your first 10-day course before able to enroll 3 & 30 days course." class="list-group-item disabled">Enroll Now</a>';
                                }
                            }
                        }
                    ],
                ]
            ]
    ]) ?>


    </div>

</div><!-- course -->
