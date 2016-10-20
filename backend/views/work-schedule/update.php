<?php

use yii\helpers\Html;
use kartik\datetime\DateTimePicker;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\WorkSchedule */
/* @var $form ActiveForm */
?>
<div class="update">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'studentID')->textInput(['readonly' => true]) ?>
        <?= $form->field($model, 'start')->widget(DateTimePicker::className(), [
            'name' => 'dp_3',
            'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'yyyy-mm-dd hh:ii'
            ]
        ]); ?>

        <?= $form->field($model, 'end')->widget(DateTimePicker::className(), [
            'name' => 'dp_3',
            'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'yyyy-mm-dd hh:ii'
            ]
        ]); ?>

        <?= $form->field($model, 'courseID')->textInput(['readonly' => true]) ?>
        <?= $form->field($model, 'note') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- update -->
