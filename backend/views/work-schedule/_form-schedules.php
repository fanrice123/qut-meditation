<?php

use yii\helpers\Html;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\field\FieldRange;

/* @var $modelsSchedule common\models\WorkSchedule[] */
/* @var $indexVolunteer integer */
?>

<?php DynamicFormWidget::begin([
    'widgetContainer' => 'dynamicform_inner',
    'widgetBody' => '.container-schedules',
    'widgetItem' => '.work-schedule-item',
    'limit' => 20,
    'min' => 1,
    'insertButton' => '.add-schedule',
    'deleteButton' => '.remove-schedule',
    'model' => $modelsSchedule[0],
    'formId' => 'dynamic-form',
    'formFields' => [
        'start',
        'end',
        'note',
    ],
]); ?>
    <table class="table table-bordered">
        <tbody class="container-schedules">
        <?php foreach ($modelsSchedule as $indexSchedule => $schedule): ?>
            <tr class="work-schedule-item">
                <td class="vcenter">
                    <?php
                    // necessary for update action.
                    /*if (! $work-schedule->isNewRecord) {
                        echo Html::activeHiddenInput($work-schedule, "[{$indexVolunteer}][{$indexSchedule}]id");
                    }*/
                    ?>
                    <table class="table table-bordered">
                        <tbody class="container->sub">
                            <tr class="sub">
                                <td>
                    <?= FieldRange::widget([
                        'form' => $form,
                        'model' => $schedule,
                        'label' => 'Time Range',
                        'attribute1' => "[{$indexSchedule}]start",
                        'attribute2' => "[{$indexSchedule}]end",
                        'type' => FieldRange::INPUT_DATETIME,
                    ]) ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                    <?= $form->field($schedule, "[{$indexSchedule}]note")->textarea(['rows' => 4]) ?>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </td>
                <td class="text-center vcenter" style="width: 90px;">
                    <button type="button" class="remove-schedule btn btn-danger btn-xs"><span class="glyphicon glyphicon-minus"></span></button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot>
        <tr>
            <th></th>
            <th class="text-center">
                <button type="button" class="add-schedule btn btn-success btn-xs"><span class="glyphicon glyphicon-plus"></span></button>
            </th>
        </tr>
        </tfoot>
    </table>
<?php DynamicFormWidget::end(); ?>