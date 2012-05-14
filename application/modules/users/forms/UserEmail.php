<?php

class Users_Form_UserEmail extends Zend_Form
{
	public function init()
	{
		$validatorlength = new Zend_Validate_StringLength(array('min' => 3, 'max' => 50));
		$validatorlength->setMessages(array(
		Zend_Validate_StringLength::TOO_LONG => "Predugačko! Maksimum je 50 karaktera!",
		Zend_Validate_StringLength::TOO_SHORT => "Prekratko! Minimum je 6 karaktera!",
		Zend_Validate_StringLength::INVALID => "Nevalidan format unosa!"
		));


		$validator = new Zend_Validate_Db_NoRecordExists(array(
		        'table' => 'users',
		        'field' => 'email'
		        )
		        );


		        $validator->setMessage("Email adresa '%value%' je registrovana! Morate uneti drugu email adresu!",Zend_Validate_Db_NoRecordExists::ERROR_RECORD_FOUND);

		        $validatorEmail = new Zend_Validate_EmailAddress();
		        $validatorEmail->setMessages(array(
		        Zend_Validate_EmailAddress::INVALID_FORMAT => "Neispravan format email adrese!",
		        Zend_Validate_EmailAddress::INVALID => "Neispravan format email adrese1!",
		        Zend_Validate_EmailAddress::DOT_ATOM => "Neispravan format email adrese2!",
		        Zend_Validate_EmailAddress::QUOTED_STRING => "Neispravan format email adrese3!",
		        Zend_Validate_EmailAddress::INVALID_HOSTNAME => "Neispravan format email adrese4!",
		        Zend_Validate_EmailAddress::INVALID_LOCAL_PART => "Neispravan format email adrese5!",
		        Zend_Validate_EmailAddress::INVALID_MX_RECORD => "Neispravan format email adrese6!",
		        Zend_Validate_EmailAddress::INVALID_SEGMENT => "Neispravan format email adrese7!",
		        Zend_Validate_EmailAddress::LENGTH_EXCEEDED => "Neispravan format email adrese8!"
		        ));

		        $validatorlength->setMax(250);

		        $validatorlength->setMessages(array(
		        Zend_Validate_StringLength::TOO_LONG => "Predugačko! Maksimum je 250 karaktera!",
		        Zend_Validate_StringLength::INVALID => "Nevalidan format unosa!"
		        ));

		        $email = $this->createElement('text', 'email');
		        $email->setLabel('Email:');
		        $email->setRequired(TRUE)
		        ->addValidator($validatorRequiered)
		        ->addValidator($validatorEmail)
		        ->addValidator($validatorlength)
		        ->addValidator($validator);
		        $email->addFilters(array(new Zend_Filter_StringTrim(), new Zend_Filter_StringToLower()))
		        ->addFilter('StripTags');
		        $email->setAttrib('size','30');
		        $this->addElement($email);

		        $this->addElement('submit','submit', array('label' => 'Pošalji zahtev'));

		        $id = $this->createElement('hidden', 'return');
		        $id->setDecorators(array('ViewHelper'));
		        $this->addElement($id);
	}
}