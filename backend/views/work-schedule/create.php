<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $modelCourseID backend\models\CourseIDForm */
/* @var $volunteer backend\models\VolunteerIDForm */
/* @var $volunteersAvailable array */
/* @var $modelsSchedule common\models\WorkSchedule[] */
/* @var $courses array */

$this->title = 'Create Work Schedule';
$this->params['breadcrumbs'][] = ['label' => 'Work Schedules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-schedule-create">

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
