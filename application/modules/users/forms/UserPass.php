<?php
class Users_Form_UserPass extends Zend_Form
{
	public function init()
	{
		$validatorPassword = new Users_Form_PasswordValidatorId(Zend_Auth::getInstance()->getIdentity()->id);
			
		$password = $this->createElement('password', 'password');
		$password->setLabel('Lozinka: ');
		$password->setRequired(TRUE)
		->addErrorMessage('Pogrešna lozinka!')
		->addValidator($validatorPassword);
		$password->addErrorMessage('Lozinka je obavezna!');
		$this->addElement($password);
		
		$validatorlength = new Zend_Validate_StringLength(array('min' => 6, 'max' => 50));
			
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
		
		$validatorIdentical = new Zend_Validate_Identical('newpassword2');
		$validatorIdentical->setMessages(array(
			Zend_Validate_Identical::MISSING_TOKEN => 'Morate uneti lozinku!',
			Zend_Validate_Identical::NOT_SAME => 'Lozinke se ne poklapaju!'
		));
		
		$password = $this->createElement('password', 'newpassword');
		$password->setLabel('Nova ozinka: ');
		$password->setRequired(TRUE)
		->addValidator($validatorRequiered)
		->addValidator($validatorlength)
		->addValidator($validatorIdentical);
		$this->addElement($password);
		
		$validatorIdentical = new Zend_Validate_Identical('newpassword');
		$validatorIdentical->setMessages(array(
			Zend_Validate_Identical::MISSING_TOKEN => 'Morate uneti lozinku!',
			Zend_Validate_Identical::NOT_SAME => 'Lozinke se ne poklapaju!'
		));
		
		$password2 = $this->createElement('password', 'newpassword2');
		$password2->setLabel('Ponovite Novu Lozinku: ');
		$password2->setRequired(TRUE)
		->addValidator($validatorRequiered)
		->addValidator($validatorlength)
		->addValidator($validatorIdentical);
		$this->addElement($password2);
		
		$this->addElement('submit','submit', array('label' => 'Sačuvaj promene'));
	
	}
}