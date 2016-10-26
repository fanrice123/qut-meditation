<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\widgets\Select2;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $modelsSchedule common\models\WorkSchedule[] */
/* @var $form yii\widgets\ActiveForm */
/* @var $isUpdate boolean */
/* @var $courses array */
/* @var $modelCourseID backend\models\CourseIDForm */
/* @var $volunteers backend\models\VolunteerIDForm[] */
/* @var $volunteersAvailable array */

?>

<div class="work-schedule-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <div class="row">
        <div class="col-sm-6">
            <?php if ($isUpdate): ?>
                <?= $form->field($modelCourseID, 'courseID')->textInput(['readonly' => true]) ?>
            <?php else: ?>
                <?= $form->field($modelCourseID, 'courseID')->widget(Select2::className(),
                    [
                        'data' => $courses,
                    ]
                ) ?>
            <?php endif; ?>
        </div>

    </div>

    <div class="padding-v-md">
        <div class="line line-dashed"></div>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th style="width: 150px">Volunteers</th>
            <th style="width: 450px;">Schedule</th>
        </tr>
        </thead>
        <tbody class="container-items">
            <tr class="volunteer-item">
                <td class="vcenter"style="vertical-align: middle;">
                    <?php
                    // necessary for update action.
                    /*if (! $volunteer->isNewRecord) {
                        echo Html::activeHiddenInput($volunteer, "[{$indexVolunteer}]id");
                    }*/
                    ?>
                    <?= $form->field($volunteer, "studentID")->label(false)->dropDownList(
                        $volunteersAvailable,
                        [
                            'width' => '250px',
                        ]
                    ) ?>
                </td>
                <td>
                    <?= $this->render('_form-schedules', [
                        'form' => $form,
                        'modelsSchedule' => $modelsSchedule,
                    ]) ?>
                    <div class="padding-v-md">
                        <div class="line line-dashed"></div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="form-group">
        <?= Html::submitButton(!$isUpdate ? 'Create' : 'Update', ['class' => !$isUpdate ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
