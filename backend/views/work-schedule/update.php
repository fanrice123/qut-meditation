<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\WorkSchedule */

$this->title = 'Update Work Schedule: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Work Schedules', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="work-schedule-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'modelCourseID' => $modelCourseID,
        'modelsSchedule' => $modelsSchedule,
        'courses' => $courses,
        'volunteer' => $volunteer,
        'isUpdate' => false,
        'volunteersAvailable' => $volunteersAvailable,
    ]) ?>

</div>
