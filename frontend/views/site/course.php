<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use kartik\grid\GridView;
use common\models\Course;
use yii\db\Query;
use common\models\User;

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
                    'class'=>'kartik\grid\ExpandRowColumn',
                    'enableRowClick' => true,
                    'expandTitle' => 'view volunteers',
                    'width'=>'100px',
                    'value'=>function ($model, $key, $index, $column) {
                        return GridView::ROW_COLLAPSED;
                    },
                    'detail'=>function ($model, $key, $index, $column) {
                        $result = (new Query())->select(['cls.courseID' ,'CONCAT(u.firstName, \' \', u.lastName) AS name'])->from('volunteer cls')
                            ->innerJoin('course c', 'cls.courseID=c.courseID')
                            ->innerJoin('user u', 'u.id=cls.studentID')
                            ->where(['cls.courseID' => $model->courseID])
                            ->all();
                        /*$subQuery = (new Query())->select(['cls.studentID', 'cls.courseID'])->from('volunteer cls')
                            ->where(['cls.courseID' => $model->courseID])
                            ->innerJoin('course c', 'cls.courseID=c.courseID');

                        $result = (new Query())->select(['CONCAT(u.firstName, \' \', u.lastName) AS name'])
                            ->from(['t' => $subQuery])
                            ->innerJoin('user u', 'u.id=cls.studentID')->all();*/
                        $volunteers = null;
                        foreach ($result as $key => $name) {
                            $volunteers .= $name['name'].', ';
                        }
                        if (empty($volunteers)) {
                            $volunteers = '<i>Currenty not accessible.</i>';
                        } else {
                            $volunteers = rtrim($volunteers, ', ');
                        }
                        return Yii::$app->controller->renderPartial('_expand-row-volunteers', [
                            'volunteers'=>$volunteers,
                            'model'=>$model,
                        ]);
                    },
                    'headerOptions'=>['class'=>'kartik-sheet-style'],
                    'expandOneOnly'=>true
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
                                    $result = common\models\Student::find()->where(['courseID' => $model->courseID, 'studentID' => Yii::$app->user->identity->id])->one();
                                    return empty($result) ? (
                                        Html::a(
                                            'Enroll Now', ['/site/enroll', 'id' => $model->courseID, 'startDate' => $model->start, 'endDate' => $model->end],
                                            [
                                                'class' => 'list-group-item list-group-item-success',
                                                'title' => 'Enroll the course now!'
                                            ]
                                        )
                                    ) : (
                                        $result['pending'] ? (
                                            '<a href="#" title="Unfortunately the class is already full. However, You have been added into waitlist. If there is any extra space, we will notice you. Thank you." class="list-group-item list-group-item-warning">Pending</a>'
                                        ) : (
                                            '<a href="#" title="You have already enrolled this course." class="list-group-item disabled">Enrolled</a>'
                                        )
                                    );
                                } else {
                                    $result = common\models\Student::find()->where(['courseID' => $model->courseID, 'studentID' => Yii::$app->user->identity->id])->one();
                                    return $model['duration']==10 ? (
                                            $result['pending'] ? (
                                                    '<a href="#" title="Unfortunately the class is already full. However, You have been added into waitlist. If there is any extra space, we will notice you. Thank you." class="list-group-item list-group-item-warning">Pending</a>'
                                                ) : (
                                                Html::a(
                                                    'Enroll Now',
                                                    ['/site/enroll', 'id' => $model->courseID, 'startDate' => $model->start, 'endDate' => $model->end],
                                                    [
                                                        'class' => 'list-group-item list-group-item-success',
                                                        'title' => 'Enroll the course now!'
                                                    ])
                                                )
                                    ) : ('<a href="#" title="You have to enroll and complete your first 10-day course before able to enroll 3 & 30 days course." class="list-group-item disabled">Enroll Now</a>');
                                }
                            }
                        }
                    ],
                ]
            ]
        ]) ?>
    </div>
</div>

</div><!-- course -->
