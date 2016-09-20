<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'User Profile - ' . $model->firstName;
//$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$attributes = [
    [
        'group'=>true,
        'label'=>'Web Information',
        'rowOptions'=>['class'=>'info']
    ],
    [
        'columns' => [
            [
                'attribute'=>'username',
                'label'=>'Username',
                'displayOnly'=>true,
                'valueColOptions'=>['style'=>'width:30%']
            ],
            [
                'attribute'=>'id',
                'format'=>'raw',
                'value'=>'<kbd>'.$model->id.'</kbd>',
                'valueColOptions'=>['style'=>'width:30%'],
                'displayOnly'=>true
            ],
        ],
    ],
    [
        'group'=>true,
        'label'=>'Personal Information',
        'rowOptions'=>['class'=>'info'],
        //'groupOptions'=>['class'=>'text-center']
    ],
    [
        'columns' => [
            [
                'attribute'=>'firstName',
                'label' => 'First Name',
                'valueColOptions'=>['style'=>'width:30%'],
            ],
            [
                'attribute'=>'lastName',
                'label' => 'Last Name',
                'valueColOptions'=>['style'=>'width:30%'],
            ],
        ],
    ],
    [
        'columns' => [
            [
                'attribute'=>'dob',
                'label'=>'Day of Birth',
                'format'=> 'date',
                'type'=>DetailView::INPUT_DATE,
                'widgetOptions' => [
                    'pluginOptions'=>['format'=>'yyyy-mm-dd']
                ],
                'valueColOptions'=>['style'=>'width:30%'],
            ],
            [
                'attribute'=>'gender',
                'label'=>'Gender',
                'type'=>DetailView::INPUT_SELECT2,
                'widgetOptions'=>[
                    'data'=>['Male', 'Female', 'others' => 'Not Specified'],
                    'options'=>['placeholder'=>'Select ...']
                ],
                'valueColOptions'=>['style'=>'width:30%']
            ],
            /*[
                'attribute'=>'author_id',
                'format'=>'raw',
                'value'=>Html::a('John Steinbeck', '#', ['class'=>'kv-author-link']),
                'type'=>DetailView::INPUT_SELECT2,
                'widgetOptions'=>[
                    'data'=>ArrayHelper::map(Author::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                    'options' => ['placeholder' => 'Select ...'],
                    'pluginOptions' => ['allowClear'=>true, 'width'=>'100%'],
                ],
                'valueColOptions'=>['style'=>'width:30%']
            ]*/
        ]
    ],
    [
        'columns'=> [
            [
                'label'=>'Residential Address',
                'attribute'=>'address',
                'valueColOptions'=>['style'=>'width:30%']
            ],
            [
                'attribute'=>'suburb',
                'label'=>'Suburb',
                'valueColOptions'=>['style'=>'width:30%']
            ]
        ]
    ],
    [
        'columns'=> [
            [
                'attribute'=>'postcode',
                'label'=>'Postcode',
                'valueColOptions'=>['style'=>'width:30%']
            ],
            [
                'attribute'=>'state',
                'label'=>'State',
                'type'=>DetailView::INPUT_SELECT2,
                'widgetOptions'=>[
                    'data'=>['ACT', 'NSW', 'NT', 'QLD', 'SA', 'TAS', 'VIC', 'WA'],
                    'options'=>['placeholder'=>'Select ...'],
                ],
                'valueColOptions'=>['style'=>'width:30%']
            ]
        ]
    ],
    [
        'group'=>true,
        'label'=>'Health & Diet',
        'rowOptions'=>['class'=>'info'],
        //'groupOptions'=>['class'=>'text-center']
    ],
    [
        'columns' => [
            [
                'attribute'=>'vegan',
                'label'=>'Vegan ?',
                'type'=>DetailView::INPUT_SWITCH,
                'value'=>$model->vegan ? 'Yes' : 'No',
                'widgetOptions' => [
                    'pluginOptions'=>['onText'=>'Yes',
                                      'offText'=>'No'
                    ]
                ],
                'valueColOptions'=>['style'=>'width:10%']
            ],
            [
                'attribute'=>'allergies',
                'label'=>'Allergies',
                'format'=>'raw',
                'value'=>'<span class="text-justify"><em>' . $model->allergies . '</em></span>',
                'type'=>DetailView::INPUT_TEXTAREA,
                'widgetOptions' => [
                    'rows' => 4
                ],
                'valueColOptions'=>['style'=>'width:50%']
            ],
        ]
    ],
    [
        'attribute'=>'medicInfo',
        'format'=>'raw',
        'value'=>'<span class="text-justify"><em>' . $model->medicInfo . '</em></span>',
        'type'=>DetailView::INPUT_TEXTAREA,
        'options'=>['rows'=>4],
        'valueColOptions'=>['style'=>'width:80%']
    ]
];

?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>


    <?php $form = ActiveForm::begin() ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => $attributes,
        'bordered' => true,
        'responsive' => true,
        'hover' => true,
        'panel'=>[
            'heading'=>'<i class="glyphicon glyphicon-user"></i> General Info',
            'type'=>'primary'
        ],
        'buttons1' => '{update}',
        'buttons2' => '{reset} {view} {save}'
    ]) ?>

    <?php ActiveForm::end() ?>

</div>
