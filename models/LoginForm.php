<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends Model
{
    public $username;
    public $mobile_phone;
    public $email;
    public $password;
    public $rememberMe = true;
    public $verifyCode;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['password'], 'required'],
            [['mobile_phone'], 'integer'],
            [['email'], 'email'],
            [['password'], 'required'],

            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'password' => '密码',
            'rememberMe' => '记住我',
            'verifyCode' => '验证码',
            'accessToken' => 'AccessToken',
        ];
    }


    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {

        if (!$this->hasErrors()) {
            if (isset($this->email)) {
                $user = $this->getEmail();
            } else {
                $user = $this->getMobilePhone();
            }
            if (!$user || !$user->validatePassword(md5($this->password))) {
                $this->addError($attribute, '错误的用户名和密码！');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            if (isset($this->email)) {
                return Yii::$app->user->login($this->getEmail(), $this->rememberMe ? 3600*24*30 : 0);
            } else {
                return Yii::$app->user->login($this->getMobilePhone(), $this->rememberMe ? 3600*24*30 : 0);
            }
        }
        return false;
    }

    /**
     * Finds user by [[email]]
     *
     * @return User|null
     */
    public function getEmail()
    {
        if ($this->_user === false) {
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    }


    /**
     * Finds user by [[mobilePhone]]
     *
     * @return User|null
     */
    public function getMobilePhone()
    {
        if ($this->_user === false) {
            $this->_user = User::findByMobilePhone($this->mobile_phone);
        }

        return $this->_user;
    }
}
