<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 9/30/2016
 * Time: 6:02 PM
 */

namespace frontend\models;

use common\models\LoginForm;
use common\models\User;
use Yii;

class ChangePasswordForm extends LoginForm
{
    public $newPassword, $confirmNewPassword;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //password is required only if new password is filled
            [['password', 'newPassword', 'confirmNewPassword'], 'required'],
            // password is validated by LoginForm::validatePassword()
            ['password', 'validatePassword'],
            ['confirmNewPassword', 'compare', 'compareAttribute'=>'newPassword', 'message'=>"New Passwords don't match" ],
        ];
    }

    public function changePassword()
    {
        if (!$this->validate()) {
            return false;
        }

        $user = User::findOne(Yii::$app->user->id);
        $user->setPassword($this->newPassword);
        $user->generateAuthKey();
        return $user->save()? $user : null;
    }

    /**
     * @inheritdoc
     */
    public function validatePassword($attribute, $params)
    {
        $user = User::findOne(Yii::$app->user->id);
        if (!$user || !$user->validatePassword($this->password)) {
            $this->addError($attribute, 'Incorrect password.');
        }
    }
}