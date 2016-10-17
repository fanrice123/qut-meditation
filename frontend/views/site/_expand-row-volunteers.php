<?php



use kartik\detail\DetailView;
use common\models\Course;

/* @var $this yii\web\View */
/* @var $volunteers string|null */
/* @var $model common\models\Course */

?>


<div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
        <h3>Staff</h3>
        <?= DetailView::widget([
            'model' => $model,
            'bordered' => true,
            'responsive' => true,
            'hover' => true,
            'panel'=>[
                'heading'=>'<i class="glyphicon glyphicon-user"></i> General Info',
                'type'=>'primary'
            ],
            'enableEditMode' => false,
            'attributes' => [
                [
                    'attribute'=>'volunteers',
                    'format'=>'raw',
                    'value'=>'<span class="text-justify"><em>' . $volunteers . '</em></span>',
                    'options'=>['rows'=>5],
                    'valueColOptions'=>['style'=>'width:80%']
                ]
            ]
        ]) ?>
    </div>
</div>


