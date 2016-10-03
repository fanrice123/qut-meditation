<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form ActiveForm */

$this->title = 'Security Setting - Email';
$this->params['breadcrumbs'][] = $this->title;
$this->params['fluid'] = true;
?>

<div class="col-md-2">

    <div class="list-group" id="setting-nav">
        <a class="list-group-item collapsed" data-toggle="collapse" data-parent="#setting-nav" href="#general-setting" aria-expanded="false">
            <i class="glyphicon glyphicon-chevron-down"></i>General Personal Info
        </a>
        <div id="general-setting" class="submenu panel-collapse collapse" role="tabpanel">
            <?= Html::a('<i class="glyphicon glyphicon-menu-right"></i>Personal Info', ['user/view'], ['class' => 'list-group-item', 'id' => 'sub-item']) ?>
        </div>
        <a class="list-group-item active" data-toggle="collapse" data-parent="#setting-nav" href="#security-setting" aria-expanded="true">
            <i class="glyphicon glyphicon-chevron-down"></i>Security Setting
        </a>
        <div id="security-setting" class="submenu panel-collapse collapse in" role="tabpanel">
            <?= Html::a('<i class="glyphicon glyphicon-menu-right"></i>Email', ['user/change-email'], ['class' => 'list-group-item active', 'id' => 'sub-item']) ?>
            <?= Html::a('<i class="glyphicon glyphicon-menu-right"></i>Password', ['user/change-password'], ['class' => 'list-group-item', 'id' => 'sub-item']) ?>
        </div>
    </div>
</div>
<div class="col-md-5">
    <div class="container">
        <div class="user-changeEmail">

            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <div class="col-md-9" id="body">

                <h1><?= Html::encode($this->title) ?></h1>

                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div><!-- user-changeEmail -->
    </div>
</div>
