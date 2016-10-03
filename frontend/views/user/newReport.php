<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;
use kartik\widgets\Select2;
use common\widgets\Alert;
use kartik\markdown\MarkdownEditor;


/* @var $this yii\web\View */
/* @var $model common\models\Report */
/* @var $form ActiveForm */
/* @var $courses mixed */

$this->title = 'Create Report';
$this->params['breadcrumbs'][] = 'New Report';
$this->params['fluid'] = true;
?>
<div class="col-md-2">
    <br>
    <br>
    <div class="list-group">
        <?= Html::a('<i class="glyphicon glyphicon-menu-right"></i>All Reports', ['user/report'], ['class' => 'list-group-item']) ?>
        <?= Html::a('<i class="glyphicon glyphicon-menu-right"></i>Create Report', ['user/new-report'], ['class' => 'list-group-item active']) ?>
    </div>
</div>

<div class="col-md-5">
    <div class="container">
        <div class="user-newReport">

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
                <?php $form = ActiveForm::begin(); ?>

                <div class="row">
                    <div class="col-lg-4">
                        <?= $form->field($model, 'courseID')->widget(Select2::className(),
                            ['data' => $courses]
                        ) ?>
                    </div>
                    <div class="col-lg-3">
                        <?= $form->field($model, 'studentID')->textInput(['readonly' => true]) ?>
                    </div>
                    <div class="col-lg-3">
                        <?= $form->field($model, 'date')->textInput(['readonly' => true]) ?>
                    </div>

                </div>
                <div class="">
                    <?= $form->field($model, 'title') ?>
                    <?= MarkdownEditor::widget([
                        'model' => $model,
                        'attribute' => 'content',
                    ]); ?>
                </div>
    
                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div><!-- user-newReport -->
    </div>
</div>
