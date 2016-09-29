<?php

namespace common\models;

use frontend\models\SignupForm;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;

/**
 * UserSearch represents the model behind the search form about `common\models\User`.
 */
class UserForm extends SignupForm
{

    public $id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        /*
        return [
            [['id', 'admin', 'status', 'created_at', 'updated_at', 'postcode', 'vegan'], 'integer'],
            [['username', 'firstName', 'lastName', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'dob', 'gender', 'phone', 'tel', 'address', 'state', 'suburb', 'allergies', 'medicInfo'], 'safe'],
        ];
        */
        return [
            ['firstName', 'required'],
            ['lastName', 'required'],
            ['dob', 'required'],
            ['dob', 'date'],
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
            [['id', 'allergies', 'medicInfo', 'username', 'email', 'password_hash'], 'safe'],
        ];
    }

    public function copyGeneralFrom($user)
    {
        $this->id = $user->id;
        $this->username = $user->username;
        $this->postcode = $user->postcode;
        $this->vegan = $user->vegan;
        $this->firstName = $user->firstName;
        $this->lastName = $user->lastName;
        $this->dob = $user->dob;
        $this->gender = $user->gender;
        $this->phone = $user->phone;
        $this->tel = $user->tel;
        $this->address = $user->address;
        $this->state = $user->state;
        $this->suburb = $user->suburb;
        $this->allergies = $user->allergies;
        $this->medicInfo = $user->medicInfo;
        /*
return [
    [['id', 'admin', 'status', 'created_at', 'updated_at', 'postcode', 'vegan'], 'integer'],
    [['username', 'firstName', 'lastName', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'dob', 'gender', 'phone', 'tel', 'address', 'state', 'suburb', 'allergies', 'medicInfo'], 'safe'],
];
*/
    }


    /**
     * populate new personal general infos to `$user`
     *
     * @param User $user
     * @return boolean
     */
    public function updateGeneralTo($user)
    {
        $user->firstName = $this->firstName;
        $user->lastName = $this->lastName;
        $user->postcode = $this->postcode;
        $user->vegan = $this->vegan;
        $user->dob = $this->dob;
        $user->gender = $this->gender;
        $user->phone = $this->phone;
        $user->tel = $this->tel;
        $user->address = $this->address;
        $user->state = $this->state;
        $user->suburb = $this->suburb;
        $user->allergies = $this->allergies;
        $user->medicInfo = $this->medicInfo;

        return $user->save();
    }
}
