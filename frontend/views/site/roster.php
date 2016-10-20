<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\grid\GridView;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

/* @var $this yii\web\View */
/* @var $model common\models\Volunteer */
/* @var $form ActiveForm */
/* @var $dataprovider Courses */

$this->title = 'Course List';
$this->params['breadcrumbs'][] = ['label' => 'Roster', 'url' => ['roster']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-2">
    <br>
    <br>
    <div class="list-group">
        <?= Html::a('<i class="glyphicon glyphicon-menu-right"></i>All Roster', ['site/roster'], ['class' => 'list-group-item active']) ?>
        <?= Html::a('<i class="glyphicon glyphicon-menu-right"></i>Roster Table', ['site/view-roster'], ['class' => 'list-group-item']) ?>
    </div>
</div>

<div class="col-md-5">
    <div class="container">
        <div class="site-roster" >
            <br>
            <br>
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
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
                    'width' => '120px',
                ],
                [
                    'attribute' => 'course_start',
                    'width' => '250px',
                    'hAlign' => 'right',
                    'value' => function($model, $key, $index, $widget) {
                        return $model->start;
                    }
                ],
                [
                    'attribute' => 'duration_(days)',
                    'width' => '120px',
                    'hAlign' => 'right',
                    'value' => function ($model, $key, $index, $widget) {
                        return $model->duration;
                    }
                ],
                [
                    'attribute' => 'course_end',
                    'width' => '250px',
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

                            $isOldStudent = (new \yii\db\Query())->select('studentID')
                                ->from('classtable c')
                                ->innerJoin('course', 'c.courseID=course.courseID')
                                ->where(['studentID' => Yii::$app->user->identity->id])
                                ->andWhere('DATE(end) <= CURDATE()')->one();
                            if (!empty($isOldStudent)) {
                                $result = common\models\Volunteer::find()->where(['courseID' => $model->courseID, 'studentID' => Yii::$app->user->identity->id])->all();
                                return empty($result) ? Html::a(
                                    'Volunteer Now',
                                    ['/site/volunteer', 'id' => $model->courseID, 'startDate' => $model->start, 'endDate' => $model->end],
                                    ['class' => 'list-group-item list-group-item-info']
                                ) : '<a href="#" class="list-group-item disabled">Volunteered</a>';
                            } else {
                                return '<a href="#" title="Only old student can volunteer" class="list-group-item disabled">Volunteer Now</a>';
                            }
                        }
                    ],
                ]
            ]
        ]); ?>
            </div>
        </div><!-- site-roster -->
    </div>

</div>
