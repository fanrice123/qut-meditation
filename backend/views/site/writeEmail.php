<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\EmailForm */
/* @var $form ActiveForm */
/* @var $users mixed */

$url = Url::to(['userlist']);
?>
<div class="writeEmail">
    
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <?= $form->field($model, 'title') ?>
        <?= $form->field($model, 'sender')->textInput(['readonly' => true]) ?>
        <?= $form->field($model, 'receivers')->widget(Select2::className(), [
            'name' => 'color_3',
            'value' => ['red', 'green'], // initial value
            'data' => $users,
            'maintainOrder' => true,
            'options' => ['placeholder' => 'Select a receiver ...', 'multiple' => true],
            'pluginOptions' => [
                'tags' => true,
                'maximumInputLength' => 100
            ],
        ]) ?>
        <?= $form->field($model, 'content')->textarea(['rows' => 20]) ?>
    <?= $form->field($model, 'attachment')->fileInput() ?>


    <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- writeEmail -->
