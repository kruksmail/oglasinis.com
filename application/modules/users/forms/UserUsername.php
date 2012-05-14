<?php
class Users_Form_UserUsername extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');
		$validatorlength = new Zend_Validate_StringLength(array('min' => 6, 'max' => 50));
	
		$validator = new Zend_Validate_Db_NoRecordExists(array(
		        'table' => 'users',
		        'field' => 'username'
		    )
		);
		
		$validator->setMessage("Korisničko ime '%value%' već postoji!",Zend_Validate_Db_NoRecordExists::ERROR_RECORD_FOUND);
			
		$validatorlength->setMessages(array(
		Zend_Validate_StringLength::TOO_LONG => "Predugačko! Maksimum je 50 karaktera!",
		Zend_Validate_StringLength::TOO_SHORT => "Prekratko! Minimum je 6 karaktera!",
		Zend_Validate_StringLength::INVALID => "Nevalidan format unosa!"
		));
		
		$validatorRequiered = new Zend_Validate_NotEmpty();
		$validatorRequiered->setMessages(
		array(
		Zend_Validate_NotEmpty::IS_EMPTY => "Ovo polje je obavezno!"
		)
		);
		
		$validatorUsername = new Zend_Validate_Db_RecordExists(array(
		        'table' => 'users',
		        'field' => 'username'
		    )
		);
		
		$username = $this->createElement('text', 'username');
		$username->setLabel('Korisničko ime: ');
		$username->setRequired(TRUE)
		->addValidator($validatorRequiered)
		->addValidator($validatorlength)
		->addValidator($validator);
		$username->addFilter('StripTags')
		->addFilter('StringTrim');
		$this->addElement($username);		

		$validatorPassword = new Users_Form_PasswordValidatorId(Zend_Auth::getInstance()->getIdentity()->id);
		
		$password = $this->createElement('password', 'password');
		$password->setLabel('Lozinka: ');
		$password->setRequired(TRUE)
		->addErrorMessage('Pogrešna lozinka!')
		->addValidator($validatorPassword);
		$this->addElement($password);
		
		$this->addElement('submit','submit', array('label' => 'Sačuvaj promene'));
	}
}