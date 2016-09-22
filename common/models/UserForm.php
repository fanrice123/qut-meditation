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
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

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
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            [['allergies', 'medicInfo'], 'safe'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['confirmPassword', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match" ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'admin' => $this->admin,
            'dob' => $this->dob,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'postcode' => $this->postcode,
            'vegan' => $this->vegan,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'firstName', $this->firstName])
            ->andFilterWhere(['like', 'lastName', $this->lastName])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'suburb', $this->suburb])
            ->andFilterWhere(['like', 'allergies', $this->allergies])
            ->andFilterWhere(['like', 'medicInfo', $this->medicInfo]);

        return $dataProvider;
    }
}
