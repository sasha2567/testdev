<?php

namespace app\models;

use Yii;
use yii\base\Model;



/**
 * RegistrationForm is the model behind the registration form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class RegistrationForm extends Model
{
    public $username;
    public $password;
    public $confirmPassword;
    public $email;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'email', 'password', 'confirmPassword'], 'required', 'message' => 'Please enter all fields'],
            // username and email are unique
            [['username', 'email'], 'validateUser', 'message' => 'Choose another username or email'],
            // email has to be a valid email address
            ['email', 'email', 'message' => 'Please enter another email'],
            // password is validated by validatePassword()
            [['password', 'confirmPassword'], 'validatePassword', 'message' => 'Passwords must match'],
        ];
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function registration()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
            $user->created_at = date('Y-m-d');
            return $user->save();
        }
        return false;
    }

    /**
     * Validate user password and password hash
     *
     * @param $password
     * @param $confirmPassword
     * @return int
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if ($this->password !== $this->confirmPassword) {
                $this->addError($attribute, 'Passwords must match');
            }
        }
    }

    /**
     * Validate unique username and email
     *
     * @return bool
     */
    public function validateUser($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = User::findByUsername($this->username) ? User::findByUsername($this->username) : User::findByEmail($this->email);
            if ($user) {
                $this->addError($attribute, 'Choose another username or email');
            }
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username) ? User::findByUsername($this->username) : User::findByEmail($this->email);
        }
        return $this->_user;
    }
}
