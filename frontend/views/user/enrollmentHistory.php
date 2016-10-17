<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Student */
/* @var $form ActiveForm */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Finished Courses';
$this->params['breadcrumbs'][] = ['label' => 'Enrollments', 'url' => ['all-enrollments']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['fluid'] = true;
?>

<div class="col-md-2">
    <br>
    <br>
    <div class="list-group">
        <?= Html::a('<i class="glyphicon glyphicon-menu-right"></i>All Enrollments', ['user/all-enrollments'], ['class' => 'list-group-item']) ?>
        <?= Html::a('<i class="glyphicon glyphicon-menu-right"></i>Ongoing Course', ['user/current-enrollment'], ['class' => 'list-group-item']) ?>
        <?= Html::a('<i class="glyphicon glyphicon-menu-right"></i>Upcoming Courses', ['user/upcoming-enrollments'], ['class' => 'list-group-item']) ?>
        <?= Html::a('<i class="glyphicon glyphicon-menu-right"></i>Finished Courses', ['user/enrollment-history'], ['class' => 'list-group-item active']) ?>
    </div>
</div>

<div class="col-md-5">
    <div class="container">
        <div class="user-enrollment">

            <br>
            <br>
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>

            <span id="finished-courses"></span>
            <div class="col-lg-10" id="body" style="margin-bottom: 30px">
                    <h1>
                        <?= Html::encode($this->title) ?>
                        <a href="#finished-courses" class="hashlink"><i class="glyphicon glyphicon-link"></i></a>
                    </h1>
                <br>
                <br>


                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'showPageSummary' => false,
                    'striped' => true,
                    'hover' => true,
                    'export' => false,
                    'panel'=>[
                        'heading'=>'<i class="glyphicon glyphicon-calendar"></i> Finished Courses',
                        'type'=>'primary'
                    ],
                    'columns' => [
                        ['class' => 'kartik\grid\SerialColumn'],
                        [
                            'attribute' => 'courseID',
                            'vAlign' => 'middle',
                            'width' => '120px',
                        ],
                        [
                            'attribute' => 'course_start',
                            'width' => '250px',
                            'vAlign' => 'middle',
                            'hAlign' => 'right',
                            'value' => function($model, $key, $index, $widget) {
                                return $model['start'];
                            }
                        ],
                        [
                            'attribute' => 'duration_(days)',
                            'width' => '120px',
                            'hAlign' => 'center',
                            'vAlign' => 'middle',
                            'value' => function ($model, $key, $index, $widget) {
                                return $model['duration'];
                            }
                        ],
                        [
                            'attribute' => 'course_end',
                            'width' => '250px',
                            'vAlign' => 'middle',
                            'hAlign' => 'right',
                            'value' => function($model, $key, $index, $widget) {
                                return $model['end'];
                            }
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{enroll}',
                            'options' => ['style' => 'width:20%'],
                            'buttons' => [
                                'enroll' => function ($url, $model) {
                                    return  Html::a(
                                        'Create Report',
                                        ['/user/create-report', 'id' => $model['courseID'], 'startDate' => $model['start'], 'endDate' => $model['end']],
                                        ['class' => 'list-group-item list-group-item-success']
                                    );
                                }
                            ],
                        ]
                    ]
                ]) ?>
            </div>
            <span id="report"></span>
            <div class="col-lg-10" id="body">
                <h1>
                    <?= Html::encode('Reports') ?>
                    <a href="#finished-courses" class="hashlink"><i class="glyphicon glyphicon-link"></i></a>
                </h1>
            </div>
        </div><!-- user-enrollment -->
    </div>
</div>