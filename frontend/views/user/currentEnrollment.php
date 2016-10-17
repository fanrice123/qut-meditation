<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model mixed */
/* @var $form ActiveForm */
/* @var $classmates string */
/* @var $volunteers string */

$this->title = 'Ongoing Courses';
$this->params['breadcrumbs'][] = ['label' => 'Enrollments', 'url' => ['all-enrollments']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['fluid'] = true;

$attributes = [
    [
        'group'=>true,
        'label'=>'Class Info',
        'rowOptions'=>['class'=>'info']
    ],
    [
        'columns' => [
            [
                'attribute'=>'courseID',
                'label'=>'Course ID',
                'displayOnly'=>true,
                'format' => 'raw',
                'value'=>'<kbd>'.$model['courseID'].'</kbd>',
                'valueColOptions'=>['style'=>'width:30%']
            ],
            [
                'attribute'=>'duration',
                'label'=>'Course Length',
                'value'=> $model['duration'].' days',
                'valueColOptions'=>['style'=>'width:30%'],
                'displayOnly'=>true
            ],
        ],
    ],
    [
        'group'=>true,
        'label'=>'Date',
        'rowOptions'=>['class'=>'info'],
        //'groupOptions'=>['class'=>'text-center']
    ],
    [
        'columns' => [
            [
                'attribute'=>'start',
                'label' => 'Date of Start',
                'valueColOptions'=>['style'=>'width:30%'],
            ],
            [
                'attribute'=>'end',
                'label' => 'Date of End',
                'valueColOptions'=>['style'=>'width:30%'],
            ],
        ],
    ],
    [
        'group'=>true,
        'label'=>'Participants',
        'rowOptions'=>['class'=>'info'],
        //'groupOptions'=>['class'=>'text-center']
    ],
    [
        'attribute'=>'classmates',
        'format'=>'raw',
        'value'=>'<span class="text-justify"><em>' . $classmates . '</em></span>',
        'options'=>['rows'=>5],
        'valueColOptions'=>['style'=>'width:80%']
    ],
    [
        'attribute'=>'volunteers',
        'format'=>'raw',
        'value'=>'<span class="text-justify"><em>' . $volunteers . '</em></span>',
        'options'=>['rows'=>5],
        'valueColOptions'=>['style'=>'width:80%']
    ]
];
?>

<div class="col-md-2">
    <br>
    <br>
    <div class="list-group">
        <?= Html::a('<i class="glyphicon glyphicon-menu-right"></i>All Enrollments', ['user/all-enrollments'], ['class' => 'list-group-item']) ?>
        <?= Html::a('<i class="glyphicon glyphicon-menu-right"></i>Ongoing Course', ['user/current-enrollment'], ['class' => 'list-group-item active']) ?>
        <?= Html::a('<i class="glyphicon glyphicon-menu-right"></i>Upcoming Courses', ['user/upcoming-enrollments'], ['class' => 'list-group-item']) ?>
        <?= Html::a('<i class="glyphicon glyphicon-menu-right"></i>Finished Courses', ['user/enrollment-history'], ['class' => 'list-group-item']) ?>
    </div>
</div>

<div class="col-md-5">
    <div class="container">
        <div class="user-currentEnrollment">

            <br>
            <br>
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>

            <div class="col-lg-10" id="body">
                <h1><?= Html::encode($this->title) ?></h1>
                <br>
                <br>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => $attributes,
                    'enableEditMode' => false,
                    'bordered' => true,
                    'responsive' => true,
                    'hover' => true,
                    'panel'=>[
                        'heading'=>'<i class="glyphicon glyphicon-calendar"></i> Current Enrollment',
                        'type'=>'primary',
                    ],
                ]) ?>

            </div>

        </div><!-- user-currentEnrollment -->
    </div>
</div>