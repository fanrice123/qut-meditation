<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\grid\GridView;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii2fullcalendar\yii2fullcalendar;

/* @var $this yii\web\View */
/* @var $model common\models\Volunteer */
/* @var $form ActiveForm */
/* @var $dataprovider Courses */
/* @var $events \yii2fullcalendar\models\Event */

$this->title = 'Roster Timetable';
$this->params['breadcrumbs'][] = ['label' => 'Roster', 'url' => ['view-roster']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-2">
    <br>
    <br>
    <div class="list-group">
        <?= Html::a('<i class="glyphicon glyphicon-menu-right"></i>All Roster', ['site/roster'], ['class' => 'list-group-item']) ?>
        <?= Html::a('<i class="glyphicon glyphicon-menu-right"></i>Roster Table', ['site/view-roster'], ['class' => 'list-group-item active']) ?>
    </div>
</div>

<div class="col-md-5">
    <div class="container">
        <div class="site-roster" >
            <br>
            <br>
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <div class="col-lg-10" id="body">
                <h1><?= Html::encode($this->title) ?></h1>
                <?= yii2fullcalendar::widget([
                    'events' => $events,
                ]) ?>
            </div>
        </div><!-- site-roster -->
    </div>

</div>
