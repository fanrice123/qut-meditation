<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'User Profile - ' . $model->firstName;
//$this->title = $model->id;
//$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['fluid'] = true;


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
                    'data'=>['male' => 'Male', 'female' => 'Female', 'others' => 'Not Specified'],
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
                    'data'=>['ACT' => 'ACT',
                             'NSW' => 'NSW',
                             'NT' => 'NT',
                             'QLD' => 'QLD',
                             'SA' => 'SA',
                             'TAS' => 'TAS',
                             'VIC' => 'VIC',
                             'WA' => 'WA'
                    ],
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

<div class="col-md-2">

    <div class="list-group" id="setting-nav">
        <a class="list-group-item active" data-toggle="collapse" data-parent="#setting-nav" href="#general-setting" aria-expanded="true">
            General Personal Info <b class="caret"></b>
        </a>
        <div id="general-setting" class="submenu panel-collapse collapse in" role="tabpanel">
            <?= Html::a('Personal Info', ['user/view'], ['class' => 'list-group-item active', 'id' => 'sub-item']) ?>
        </div>
        <a class="list-group-item" data-toggle="collapse" data-parent="#setting-nav" href="#security-setting" aria-expanded="false">
            Security Seting <b class="caret"></b>
        </a>
        <div id="security-setting" class="submenu panel-collapse collapse" role="tabpanel">
            <?= Html::a('Email', ['user/change-email'], ['class' => 'list-group-item', 'id' => 'sub-item']) ?>
            <?= Html::a('Password', ['change-password'], ['class' => 'list-group-item']) ?>
        </div>
    </div>

</div>

<div class="col-md-5">
<div class="container">
    <div class="user-view">
    <?= Breadcrumbs::widget([
        'links' => $this->params['breadcrumbs'],
    ]) ?>
    <?= Alert::widget() ?>
    <div class="col-md-9" id="body">

        <h1><?= Html::encode($this->title) ?></h1>


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
    </div><!-- user-view -->
</div>
</div>