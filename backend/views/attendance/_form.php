<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\AttendanceForm */
/* @var $form ActiveForm */
/* @var $courses array */
?>

<div class="attendance-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'courseID')->widget(Select2::className(), [
        'data' => $courses,
    ]) ?>
    <?= $form->field($model, 'day')->widget(DepDrop::className(), [
        'type' => DepDrop::TYPE_SELECT2,
        'options' => ['placeholder' => 'Select ...'],
        'pluginOptions'=>[
            'depends'=>['attendanceform-courseid'],
            'url' => Url::to(['/attendance/load-days']),
            'loadingText' => 'Loading days ...',
        ],
    ]) ?>
    <?= $form->field($model, 'file')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
