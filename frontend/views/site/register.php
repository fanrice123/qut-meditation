<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup" id="body">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to register your first 10-day course:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
            <div class="row-by-row">
                <div class="two-cols">
                    <section>
                        <?= $form->field($model, 'firstName')->textInput(['cols' => 50]) ?>
                    </section>
                    <section>
                        <?= $form->field($model, 'lastName')->textInput(['cols' => 50]) ?>
                    </section>
                </div>
                <div>
                    <?= $form->field($model, 'password')->passwordInput() ?>
                    <?= $form->field($model, 'confirmPassword')->passwordInput() ?>
                </div>
            </div>
            <?= $form->field($model, 'gender')->radioList(['male' => 'Male',
                                                                'female' => 'Female',
                                                                'other' => 'Not Specified'],
                                                                ['itemOptions' => ['style' => 'display:inline'],
                                                                 'separator' => '   ']) ?>
            <?= $form->field($model, 'dob')->widget(DatePicker::className(),
                [
                    'name'=>'dp_3',
                    'type'=>DatePicker::TYPE_COMPONENT_APPEND,
                    //'value'=> date('M-dd-yyyy'),
                    'pluginOptions'=>[
                        'autoclose'=>true,
                        'format'=>'yyyy-mm-dd'
                    ]
                ])
            ?>
            <?= $form->field($model, 'email')->input('email') ?>
            <?= $form->field($model, 'tel')->textInput(/*['cols' => 50]*/)->label('Tel No.') ?>

            <?= $form->field($model, 'phone')->textInput(['cols' => 50]) ?>


            <?= $form->field($model, 'address') ?>
            <?= $form->field($model, 'suburb') ?>
            <?= $form->field($model, 'postcode') ?>
            <?= $form->field($model, 'state') ?>
            <div class="three-rols">
                <section>
                    <?= $form->field($model, 'vegan')->radioList([1 => 'Yes', 0 => 'No']) ?>
                </section>
                <section>
                    <?= $form->field($model, 'allergies')->textarea(['rows' => 6, 'cols' => 50]) ?>
                </section>
                <section>
                    <?= $form->field($model, 'medicInfo')->textarea(['rows' => 6, 'cols' => 50]) ?>
                </section>
            </div>
            <div class="form-group">
                <?= Html::submitButton('Register', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
