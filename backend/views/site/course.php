<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Course */
/* @var $form ActiveForm */
?>
<div class="course">

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
    
        <div class="form-group">
            <?= Html::submitButton('Create Course', ['class' => 'btn btn-primary',
                                                      'name' => 'create-button']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- course -->
