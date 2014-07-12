<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends BaseForm
{
	public $username;
	public $password;
//	public $remember_me;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password', 'required','message'=> $this->_messages['fill the field'].' "{attribute}"'),
			// rememberMe needs to be a boolean
//			array('remember_me', 'boolean'),
			// password needs to be authenticated
			array('password', 'authenticate'),
		);
	}


	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
    public function authenticate($attribute,$params)
    {
        if(!$this->hasErrors())
        {
            $this->_identity=new UserIdentity($this->username,$this->password);
            if(!$this->_identity->authenticate())
            {
                if($this->_identity->errorCode == UserIdentity::ERROR_PASSWORD_INVALID){$this->addError('password',$this->_messages['Incorrect password']);}
                if($this->_identity->errorCode == UserIdentity::ERROR_USERNAME_INVALID){$this->addError('username',$this->_messages['This user not exist']);}
                if($this->_identity->errorCode == UserIdentity::ERROR_UNKNOWN_IDENTITY){$this->addError('username',$this->_messages['Unknown error. Authentication failed']);}
            }
        }
    }
    
    
    public function attributeLabels()
	{
		return array(
			'username' => $this->_labels['login'],
            'password' => $this->_labels['password']
		);
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			Yii::app()->user->login($this->_identity);
			return true;
		}
		else
        {
            return false;
        }

	}
}
