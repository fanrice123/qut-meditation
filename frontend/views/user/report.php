<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use kartik\grid\GridView;
use yii\bootstrap\Collapse;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $model common\models\Student */
/* @var $form ActiveForm */
/* @var $courses array */

$this->title = 'All Reports';
$this->params['breadcrumbs'][] = 'Report';
$this->params['fluid'] = true;
?>

<div class="col-md-2">
    <br>
    <br>
    <div class="list-group">
        <?= Html::a('<i class="glyphicon glyphicon-menu-right"></i>All Reports', ['user/report'], ['class' => 'list-group-item active']) ?>
        <?= Html::a('<i class="glyphicon glyphicon-menu-right"></i>Create Report', ['user/new-report'], ['class' => 'list-group-item']) ?>
    </div>
</div>

<div class="col-md-5">
    <div class="container">
        <div class="user-report">

            <br>
            <br>
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>

            <div class="col-lg-10" id="body">
                <h1><?= Html::encode($this->title) ?></h1>
                <br>
                <br>
                <?= Collapse::widget([
                'items' => $courses
                ]);
                ?>

            </div>
        </div><!-- user-report -->
    </div>
</div>