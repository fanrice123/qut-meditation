<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 9/30/2016
 * Time: 6:02 PM
 */

namespace frontend\models;

use frontend\models\ChangePasswordForm;
use common\models\User;
use Yii;

class ChangeEmailForm extends ChangePasswordForm
{
    public $email;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //password is required only if new password is filled
            [['password', 'email'], 'required'],
            // password is validated by LoginForm::validatePassword()
            ['password', 'validatePassword'],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
        ];
    }

    public function changeEmail()
    {
        if (!$this->validate()) {
            return false;
        }

        $user = User::findOne(Yii::$app->user->id);
        $user->email = $this->email;
        return $user->save()? $user : null;
    }
}