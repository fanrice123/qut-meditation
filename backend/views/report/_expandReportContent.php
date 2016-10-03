<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\markdown\Markdown;

/* @var $this yii\web\View */
/* @var $model common\models\Report */
/* @var $form ActiveForm */
?>
<div class="expandReportContent">

    <h1>Title : <b><?= $title ?></b></h1>
    <br>
    <br>
    <br>
    <div class="col-lg-6">
        <div class="container-fluid" id="body">
            <?= $content ?>
        </div>
    </div>

</div><!-- _expandReportContent -->
