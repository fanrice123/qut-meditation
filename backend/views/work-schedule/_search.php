<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\WorkScheduleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="work-schedule-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'courseID') ?>

    <?= $form->field($model, 'studentID') ?>

    <?= $form->field($model, 'start') ?>

    <?= $form->field($model, 'end') ?>

    <?php // echo $form->field($model, 'note') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
