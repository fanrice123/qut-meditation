<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\markdown\Markdown;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $query yii\db\Query */

$this->title = 'Reports';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Report', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class'=>'kartik\grid\SerialColumn',
                'contentOptions'=>['class'=>'kartik-sheet-style'],
                'width'=>'36px',
                'header'=>'',
                'headerOptions'=>['class'=>'kartik-sheet-style']
            ],
            [
                'attribute' => 'reportID',
                'width' => '120px',
                'vAlign' => 'middle',
                'hAlign' => 'right',
            ],
            [
                'attribute' => 'courseID',
                'width' => '120px',
                'vAlign' => 'middle',
                'hAlign' => 'right',
            ],
            [
                'attribute' => 'studentID',
                'width' => '120px',
                'vAlign' => 'middle',
                'hAlign' => 'right',
            ],
            [
                'attribute' => 'title',
                'vAlign' => 'middle',
                'hAlign' => 'right',
            ],
            [
                'attribute' => 'date',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                /*'value' => function($model, $key, $index, $widget) {
                    return $model['date'];
                },
                /*'filter'=>DatePicker::widget([
                    'options' => ['placeholder' => 'Select issue date ...'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                    ]
                ]),*/
            ],
            [
                //'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'start',
                'width' => '120px',
                'hAlign'=>'center',
                'vAlign'=>'middle',
                /*'filter'=>DatePicker::widget([
                    'options' => ['placeholder' => 'Select issue date ...'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                    ]
                ]),
                'value' => function($model, $key, $index, $widget) {
                    return $model['start'];
                },
                /*'editableOptions'=>[
                    'header'=>'Publish Date',
                    'size'=>'md',
                    'inputType'=>\kartik\editable\Editable::INPUT_WIDGET,
                    'widgetClass'=> 'kartik\datecontrol\DateControl',
                    'options'=>[
                        'type'=>\kartik\datecontrol\DateControl::FORMAT_DATE,
                        'displayFormat'=>'dd.MM.yyyy',
                        'saveFormat'=>'php:Y-m-d',
                        'options'=>[
                            'pluginOptions'=>[
                                'autoclose'=>true
                            ]
                        ]
                    ]
                ],*/
            ],
            /*[
                'class'=>'kartik\grid\EditableColumn',
                'attribute' => 'start',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'format'=>'date',
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['format'=>'yyyy-mm-dd']
                ],
                'editableOptions'=>[
                    'header'=>'Publish Date',
                    'size'=>'md',
                    'inputType'=>\kartik\editable\Editable::INPUT_WIDGET,
                    'widgetClass'=> 'kartik\datecontrol\DateControl',
                     'options'=>[
                         'type'=>\kartik\datecontrol\DateControl::FORMAT_DATE,
                         'displayFormat'=>'dd.MM.yyyy',
                        'saveFormat'=>'php:Y-m-d',
                        'options'=>[
                            'pluginOptions'=>[
                                'autoclose'=>true
                            ]
                        ]
                    ]
                ],
            ],*/
            [
                'attribute' => 'duration',
                'width' => '120px',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                /*'value' => function ($model, $key, $index, $widget) {
                    return $model['duration'];
                }*/
            ],
            [
                'attribute' => 'end',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                /*'value' => function($model, $key, $index, $widget) {
                    return $model['end'];
                }*/
            ],
            [
                'class'=>'yii\grid\ActionColumn',
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($model, $key, $index) {
                        return '<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#report-'.$index.'">View</button>';
                    }
                ]
            ],
            /*[
                'class'=>'kartik\grid\ExpandRowColumn',
                'width'=>'50px',
                'value'=>function ($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                'detail'=>function ($model, $key, $index, $column) {
                    return Yii::$app->controller->renderPartial('_expandReportContent',
                        [
                            'content' => Markdown::convert($model['content']/*, ['custom' => [
                                '<p>' => Html::beginTag('p', ['style' => 'width: 500px'])
                            ]]
                            ),
                            'title' => $model['title'],
                        ]
                    );
                },
                'headerOptions' => ['class'=>'kartik-sheet-style'],
                'expandOneOnly' => false,
            ],*/
        ],
        'panel'=>[
            'heading'=>'<i class="glyphicon glyphicon-book"></i>',
            'type'=>'primary'
        ],
        'toolbar' => [
            [
                'content'=>
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], [
                        'class' => 'btn btn-default',
                        'title' => 'Reset Grid'
                    ]),
            ],
            '{toggleData}'
        ],
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'export' => false,
        'responsive' => true,
        'hover' => true,
        'striped' => true,
        'condensed' => true,
        'persistResize'=>false,
    ]); ?>
<?php Pjax::end(); ?>
</div>

<?php $data = $dataProvider->getModels(); ?>


<!-- Modal -->
<?php foreach($data as $key => $value): ?>
<div id="report-<?= $key ?>" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <?= '<h2 class="modal-title"> Report R'.sprintf('%04d', $value['reportID']).': '.$value['title'].'</h2>' ?>
            </div>
            <div class="modal-body">
                <?= Markdown::convert($value['content']); ?>
                <!--<p>Some text in the modal.</p>-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<?php endforeach; ?>
