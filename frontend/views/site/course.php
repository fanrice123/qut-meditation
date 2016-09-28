<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider common\models\Course */
/* @var $form ActiveForm */
/* @var $dataprovider Courses */

$this->title = 'Course List';
$this->params['breadcrumbs'][] = ['label' => 'Course', 'url' => ['course']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="course" id="body">

    <h1><?= Html::encode($this->title) ?></h1>


    <div class="col-lg-10">
        <!--<?php if (Yii::$app->session->hasFlash('success')): ?>
            <div class="alert alert-success alert-dismissable">
                <?= Yii::$app->session->getFlash('success') ?>
            </div>
        <? elseif (Yii::$app->session->hasFlash('warning')): ?>
            <div class="alert alert-danger alert-dismissable">
                <?= Yii::$app->session->getFlash('warning') ?>
            </div>
        <?php endif; ?>

        <!--<?php $form = ActiveForm::begin(); ?>-->

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'showPageSummary' => false,
            'striped' => true,
            'hover' => true,
            'export' => false,
            'panel'=>[
                'heading'=>'<i class="glyphicon glyphicon-calender"></i> Courses Available',
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
                            return Html::a(
                                '<span class="glyphicon glyphicon-education">Enroll Now</span>',
                                ['/site/enroll', 'id' => $model->courseID, 'date' => $model->start],
                                ['title' => 'Enroll']
                                );
                        }
                    ],
                ]
            ]
    ]) ?>
    
      <!--  <div class="form-group">
            <!--<?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>-->


    </div>

</div><!-- course -->
