<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Course */
/* @var $form ActiveForm */
/* @var $dataProvider \yii\data\ActiveDataProvider */

?>
<div class="course">

    <h2>Courses</h2>
    <br>
    <br>

    <div class="row" >
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
        ]
    ]) ?>
    </div>


    <?php $form = ActiveForm::begin([
        'id'=>'course-form',
        'options'=>['class'=>'form-horizontal']
    ]); ?>

    <?= $form->field($model, 'start')->widget(DatePicker::className(),
        [
            'name'=>'dp_3',
            'type'=>DatePicker::TYPE_COMPONENT_APPEND,
            //'value'=> date('M dd,yyyy'),
            'pluginOptions'=>[
                'autoclose'=>true,
                'format'=>'yyyy-mm-dd'
            ]
        ])
    ?>
    <?= $form->field($model, 'duration')->dropdownList(
        [
            '3' => '3',
            '10' => '10',
            '30' => '30'
        ],
        ['prompt'=>'Select course duration'])
    ?>
    <?= $form->field($model, 'student_max') ?>
    <?= $form->field($model, 'waitList') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Create Course', ['class' => 'btn btn-primary',
                                                      'name' => 'create-button']) ?>
        </div>
    <?php ActiveForm::end(); ?>


</div><!-- course -->
