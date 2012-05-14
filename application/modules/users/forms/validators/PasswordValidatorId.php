<?php
class Users_Form_Validators_PasswordValidatorId extends Zend_Validate_Abstract
{	
	private $id = null;
	public function __construct($id)
	{
		$this->id = $id;
	}
	public function isValid($value)
    {	
    	$validatorPassword = new Zend_Validate_Db_RecordExists(array(
		        'table' => 'users',
    			'field' => 'password'
		    )
		);
		
		$mdlUsers = new Users_Model_User();
		
		if($validatorPassword->isValid(md5($value))) //&& $validatorUsername->isValid($this->username))
		{
			$result = $mdlUsers->getUserByIdPass($this->id,md5($value));
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