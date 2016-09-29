<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $confirmPassword;
    public $firstName, $lastName;
    public $dob;
    public $phone, $tel;
    public $address, $postcode, $state, $suburb;
    public $gender;
    public $allergies;
    public $vegan;
    public $medicInfo;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['firstName', 'required'],
            ['lastName', 'required'],
            ['dob', 'required'],
            ['dob', 'date', 'format' => 'yyyy-mm-dd'],
            ['gender', 'required'],
            ['phone', 'required'],
            ['phone', 'trim'],
            ['phone', 'integer'],
            ['address', 'required'],
            ['postcode', 'required'],
            ['postcode', 'integer', 'min' => 0, 'max' => 10000],
            ['state', 'required'],
            ['suburb', 'required'],
            ['vegan', 'required'],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            [['allergies', 'medicInfo', 'tel'], 'safe'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['confirmPassword', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match" ],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->firstName = $this->firstName;
        $user->lastName = $this->lastName;
        $user->dob = $this->dob;
        $user->gender = $this->gender;
        $user->address = $this->address;
        $user->phone = $this->phone;
        $user->tel = $this->tel;
        $user->postcode = $this->postcode;
        $user->suburb = $this->suburb;
        $user->state = $this->state;
        $user->vegan = $this->vegan;
        $user->allergies = $this->allergies;
        $user->medicInfo = $this->medicInfo;
        $user->email = $this->email;
        $user->admin = false;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }

    public function copyValueTo(&$user)
    {
        $user->firstName = $this->firstName;
        $user->lastName = $this->lastName;
        $user->dob = $this->dob;
        $user->gender = $this->gender;
        $user->address = $this->address;
        $user->phone = $this->phone;
        $user->tel = $this->tel;
        $user->postcode = $this->postcode;
        $user->suburb = $this->suburb;
        $user->state = $this->state;
        $user->vegan = $this->vegan;
        $user->allergies = $this->allergies;
        $user->medicInfo = $this->medicInfo;

        return $user->save();
    }
}
