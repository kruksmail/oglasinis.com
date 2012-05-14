<?php
class Users_Form_Validators_PasswordValidator extends Zend_Validate_Abstract
{	
	private $username = null;
	public function __construct($username)
	{
		$this->username = $username;
	}
	public function isValid($value)
    {	
    	$validatorPassword = new Zend_Validate_Db_RecordExists(array(
		        'table' => 'users',
    			'field' => 'password'
		    )
		);
		
		$validatorTmpPassword = new Zend_Validate_Db_RecordExists(array(
		        'table' => 'temporarypassword',
    			'field' => 'password'
		    )
		);
		
		$mdlUsers = new Users_Model_User();
		
		if($validatorPassword->isValid(md5($value))) //&& $validatorUsername->isValid($this->username))
		{
			$result = $mdlUsers->getUserByUsernamePass($this->username,md5($value));
			if($result)
			{
				return true;
			}
			$this->_error('Pogrešna lozinka!');
			return false;
		}		
		else
		{
			$mdlTmp = new Users_Model_UserRecovery();
			if($validatorTmpPassword->isValid(md5($value)))
			{
				$result = $mdlTmp->getUserByUsernamePass($this->username,md5($value));
				if($result)
				{
					return true;
				}
				$this->_error('Pogrešna lozinka!');
				return false;
			}
			else
			{	
				$this->_error('Pogrešna lozinka!');
				return false;
			}
		}
    }
}