<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AttendanceForm */
/* @var $form yii\widgets\ActiveForm */
/* @var $courses array */

$this->title = 'Create Attendance Record';
$this->params['breadcrumbs'][] = ['label' => 'Attendances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attendance-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'courses' => $courses,
        'test' => $test,
    ]) ?>

</div>
